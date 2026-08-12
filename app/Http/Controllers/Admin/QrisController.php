<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QrisSetting;
use App\Services\QrisService;
use Illuminate\Http\Request;

class QrisController extends Controller
{
    public function index()
    {
        $setting = QrisSetting::first();

        if (!$setting) {
            $setting = QrisSetting::create([
                'merchant_name' => 'Terapis Online Indonesia',
                'merchant_city' => 'Jakarta Selatan',
                'provider_name' => 'QRIS Dinamis Bank / E-Wallet',
                'bank_name' => 'Bank Central Asia (BCA)',
                'bank_account_number' => '8830991204',
                'bank_account_holder' => 'PT Terapis Online Indonesia',
                'qris_image' => null,
                'static_payload' => '00020101021126580014ID.LINKAJA.WWW0118936009110021035252021520091100210352520303UMI51440014ID.CO.QRIS.WWW0215ID10200210352520303UMI5204581253033605802ID5914Terapis Online6007Jakarta6304',
            ]);
        }

        return view('admin.qris', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'merchant_name' => 'required|string|max:255',
            'merchant_city' => 'required|string|max:255',
            'provider_name' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'bank_account_holder' => 'nullable|string|max:255',
            'qris_image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'static_payload' => 'nullable|string',
        ]);

        $setting = QrisSetting::firstOrCreate([], [
            'merchant_name' => 'Terapis Online Indonesia',
            'merchant_city' => 'Jakarta Selatan',
            'provider_name' => 'QRIS Dinamis Bank / E-Wallet',
        ]);

        $setting->merchant_name = $request->merchant_name;
        $setting->merchant_city = $request->merchant_city;
        $setting->provider_name = $request->provider_name ?? 'QRIS Dinamis Bank / E-Wallet';
        $setting->bank_name = $request->bank_name;
        $setting->bank_account_number = $request->bank_account_number;
        $setting->bank_account_holder = $request->bank_account_holder;

        $decodedNotice = '';

        if ($request->hasFile('qris_image')) {
            $file = $request->file('qris_image');
            $filename = 'qris_gopay_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('storage/qris');
            $file->move($destinationPath, $filename);
            
            $setting->qris_image = 'storage/qris/' . $filename;

            // Automatically decode payload string from uploaded image file
            $fullPath = public_path($setting->qris_image);
            $extractedPayload = QrisService::decodeQrImagePayload($fullPath);

            if ($extractedPayload) {
                $setting->static_payload = $extractedPayload;
                $decodedNotice = ' String payload EMVCo berhasil diekstrak secara otomatis dari gambar!';
            }
        }

        if ($request->filled('static_payload') && empty($decodedNotice)) {
            $setting->static_payload = $request->static_payload;
        }

        $setting->save();

        return redirect()->back()->with('success', 'Gambar QRIS GoPay / Merchant berhasil disimpan!' . $decodedNotice);
    }
}
