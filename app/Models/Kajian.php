<?php

namespace App\Models;

use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Log;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\ErrorCorrectionLevel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kajian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getQrCodeAttribute()
    {
        $link = route('kajian.show', $this->slug);
        // Log::info('Link QR Kajian: ' . $link); // 👈 Tambahkan baris ini
        $path = 'qrcodes/' . $this->slug . '.png';

        // Buat QR Code hanya jika belum ada
        if (!Storage::disk('public')->exists($path)) {

            // ✅ Versi Endroid QR Code v6
            $qrCode = new QrCode(
                data: $link,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 10
            );

            $writer = new PngWriter();
            $result = $writer->write($qrCode);

            // Simpan hasil QR ke storage
            Storage::disk('public')->put($path, $result->getString());
        }

        return asset('storage/' . $path);
    }

    protected static function booted() 
    {
        static::updating(function ($model) {
            if ($model->isDirty('file_kajian') && ($model->getOriginal('file_kajian') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('file_kajian'));
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('cover_kajian') && ($model->getOriginal('cover_kajian') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('cover_kajian'));
            }
        });
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class);
    }

    public function infografis(): HasOne
    {
        return $this->hasOne(Infografis::class);
    }
}