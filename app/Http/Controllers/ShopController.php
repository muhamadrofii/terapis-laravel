<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use App\Services\QrisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display the public Herbal Shop page.
     */
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
    }

    /**
     * Show Checkout Page for a Product.
     */
    public function checkout($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.checkout', compact('product'));
    }

    /**
     * Store a Product Order and redirect to Payment.
     */
    public function storeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
            'shipping_address' => 'required|string',
            'whatsapp_number' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = (int)$request->quantity;
        $totalPrice = $product->price * $quantity;

        $user = Auth::user();

        $order = ProductOrder::create([
            'user_id' => $user ? $user->id : null,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'shipping_address' => $request->shipping_address,
            'whatsapp_number' => $request->whatsapp_number,
            'notes' => $request->notes,
        ]);

        return redirect()->route('shop.pay', $order->id)->with('success', 'Pesanan berhasil dibuat! Silakan bayar menggunakan QRIS Dinamis.');
    }

    /**
     * Show QRIS Payment Screen for an Order.
     */
    public function pay($id)
    {
        $order = ProductOrder::with('product')->findOrFail($id);

        $amountIdr = $order->total_price;
        $dynamicPayload = QrisService::generateDynamicPayload($amountIdr);
        $qrImageUrl = QrisService::getQrImageUrl($dynamicPayload);

        return view('shop.pay', compact('order', 'amountIdr', 'dynamicPayload', 'qrImageUrl'));
    }

    /**
     * Handle payment proof upload for an Order.
     */
    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,pdf|max:3072',
        ]);

        $order = ProductOrder::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('proofs/products', 'public');
            $order->payment_proof = 'storage/' . $path;
            $order->payment_status = 'paid';
            $order->status = 'accepted';
            $order->save();
        }

        return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran QRIS berhasil diunggah! Pesanan Anda telah dikonfirmasi dan sedang diproses.');
    }
}
