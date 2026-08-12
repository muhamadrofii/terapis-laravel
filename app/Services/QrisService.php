<?php

namespace App\Services;

use App\Models\QrisSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QrisService
{
    /**
     * Decode QR Code Payload from an Uploaded Image File or URL.
     */
    public static function decodeQrImagePayload(string $imagePath): ?string
    {
        try {
            if (file_exists($imagePath)) {
                $response = Http::attach(
                    'file', file_get_contents($imagePath), basename($imagePath)
                )->post('https://api.qrserver.com/v1/read-qr-code/');

                if ($response->successful()) {
                    $json = $response->json();
                    if (!empty($json[0]['symbol'][0]['data'])) {
                        $qrData = trim($json[0]['symbol'][0]['data']);
                        if (strpos($qrData, '000201') === 0) {
                            return $qrData;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('QR Decoder exception: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Build Dynamic QRIS Payload from Base Payload and Amount in IDR.
     */
    public static function generateDynamicPayload(int $amountIdr): string
    {
        $setting = QrisSetting::first();
        $rawPayload = $setting && !empty($setting->static_payload)
            ? trim($setting->static_payload)
            : '00020101021126580014ID.LINKAJA.WWW0118936009110021035252021520091100210352520303UMI51440014ID.CO.QRIS.WWW0215ID10200210352520303UMI5204581253033605802ID5914Terapis Online6007Jakarta6304';

        // 1. Strip trailing CRC (Tag 63 header 6304 and any CRC hex) if present
        $cleanPayload = preg_replace('/6304[A-Fa-f0-9]{0,4}$/', '', $rawPayload);

        // 2. Change Tag 010211 (Static) to 010212 (Dynamic) at the beginning of string
        if (strpos($cleanPayload, '000201010211') === 0) {
            $cleanPayload = substr_replace($cleanPayload, '000201010212', 0, 12);
        }

        // 3. Prepare Tag 54 (Transaction Amount in IDR)
        $amountStr = (string) $amountIdr;
        $amountLength = str_pad(strlen($amountStr), 2, '0', STR_PAD_LEFT);
        $tag54 = '54' . $amountLength . $amountStr;

        // 4. Remove existing Tag 54 if present
        $cleanPayload = preg_replace('/54\d{2}\d+/', '', $cleanPayload);

        // 5. Insert Tag 54 before Tag 58 (Country Code 5802ID) or Tag 59 (Merchant Name)
        if (strpos($cleanPayload, '5802ID') !== false) {
            $cleanPayload = str_replace('5802ID', $tag54 . '5802ID', $cleanPayload);
        } elseif (preg_match('/59\d{2}/', $cleanPayload, $matches, PREG_OFFSET_CAPTURE)) {
            $pos = $matches[0][1];
            $cleanPayload = substr($cleanPayload, 0, $pos) . $tag54 . substr($cleanPayload, $pos);
        } else {
            $cleanPayload .= $tag54;
        }

        // 6. Append Tag 63 Header ONCE
        $cleanPayload .= '6304';

        // 7. Calculate EMVCo CRC16-CCITT Checksum (Polynomial 0x1021, Initial 0xFFFF)
        $crc = self::calculateCrc16($cleanPayload);
        $crcHex = strtoupper(str_pad(dechex($crc), 4, '0', STR_PAD_LEFT));

        return $cleanPayload . $crcHex;
    }

    /**
     * Calculate EMVCo CRC16 CCITT Checksum (Polynomial 0x1021, Initial 0xFFFF).
     */
    public static function calculateCrc16(string $str): int
    {
        $crc = 0xFFFF;
        $len = strlen($str);

        for ($c = 0; $c < $len; $c++) {
            $crc ^= (ord($str[$c]) << 8);
            for ($i = 0; $i < 8; $i++) {
                if ($crc & 0x8000) {
                    $crc = (($crc << 1) ^ 0x1021) & 0xFFFF;
                } else {
                    $crc = ($crc << 1) & 0xFFFF;
                }
            }
        }

        return $crc;
    }

    /**
     * Get QR Image URL.
     */
    public static function getQrImageUrl(string $payload): string
    {
        return 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($payload);
    }
}
