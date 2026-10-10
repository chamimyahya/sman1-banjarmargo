<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class Berkas
{
    public static function simpan(UploadedFile $file): string
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $nama = now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$ext;
        $dir = public_path('unggah');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $file->move($dir, $nama);

        return 'unggah/'.$nama;
    }

    public static function buang(?string $path): void
    {
        if ($path && str_starts_with($path, 'unggah/')) {
            $penuh = public_path($path);
            if (is_file($penuh)) {
                unlink($penuh);
            }
        }
    }
}
