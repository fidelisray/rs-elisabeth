<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDefaultPassword
{
    /**
     * Menampilkan notifikasi peringatan kepada user yang masih menggunakan
     * password default ('123456'). Tidak memblokir akses, hanya mengingatkan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->must_change_password) {
            Notification::make()
                ->warning()
                ->title('Peringatan Keamanan Password')
                ->body('Anda masih menggunakan password default. Segera ganti password Anda melalui menu **Profil** demi keamanan akun Anda.')
                ->persistent()
                ->send();
        }

        return $next($request);
    }
}
