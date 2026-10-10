<?php

namespace App\Http\Middleware;

use App\Models\Kunjungan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CatatKunjungan
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->is('admin', 'admin/*') || ! $request->isMethod('GET')) {
            return $response;
        }

        try {
            Kunjungan::query()->firstOrCreate(
                ['tanggal' => now()->toDateString()],
                ['jumlah' => 0],
            )->increment('jumlah');
        } catch (Throwable) {
            // Tabel belum dimigrasi.
        }

        return $response;
    }
}
