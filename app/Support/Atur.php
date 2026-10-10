<?php

namespace App\Support;

use App\Models\Pengaturan;
use Throwable;

class Atur
{
    public static function ambil(string $kunci, string $bawaan = ''): string
    {
        try {
            $nilai = Pengaturan::query()->where('kunci', $kunci)->value('nilai');

            return ($nilai === null || $nilai === '') ? $bawaan : $nilai;
        } catch (Throwable) {
            return $bawaan;
        }
    }

    public static function isi(array $data): void
    {
        foreach ($data as $kunci => $nilai) {
            Pengaturan::query()->updateOrCreate(
                ['kunci' => $kunci],
                ['nilai' => $nilai ?? ''],
            );
        }
    }

    public static function banyak(array $kunci): array
    {
        $hasil = [];
        foreach ($kunci as $item => $bawaan) {
            if (is_int($item)) {
                $hasil[$bawaan] = self::ambil($bawaan);
            } else {
                $hasil[$item] = self::ambil($item, $bawaan);
            }
        }

        return $hasil;
    }
}
