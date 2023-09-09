<?php

namespace App\Services;

use App\Managers\TenantDataManger;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate a QR code for a table.
     *
     * @param int $table_number
     * @param string $style
     * @return string  Path to the generated QR code image
     */
    public function generate(int $table_number, string $style = 'square'): string
    {
        try {
            $restaurant = TenantDataManger::getTenantRestaurant();

            if (!$restaurant) {
                throw new Exception("Restaurant information not found.");
            }

            $restaurant_name = Str::slug($restaurant->name);

            $qrCode = QrCode::format('png')
                ->size(400)
                ->margin(1)
                ->style($style)
                ->encoding('UTF-8')
                ->errorCorrection('L')
                ->merge("/public/storage/$restaurant->profile_photo", .2)
                ->generate("$restaurant->domain/table/$table_number");

            $path = "uploads/$restaurant_name/qrCodes/qrCode_table_$table_number.png";
            Storage::disk('public')->put($path, $qrCode);

            return $path;
        } catch (Exception $e) {
            Log::error("QR Code generation error: " . $e->getMessage());
            return "Error generating QR code.";
        }
    }
}
