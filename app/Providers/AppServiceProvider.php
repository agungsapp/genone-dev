<?php

namespace App\Providers;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Carbon::setLocale('id');

        //
        Str::macro('rupiah', function ($value) {
            return 'Rp. ' . number_format($value, 0, '.', '.');
        });

        Str::macro('wa', function ($text) {
            if (is_string($text)) {
                return str_replace(' ', '%', $text);
            } else {
                throw new Exception('Input must be a string');
            }
        });

        Str::macro('wanomor', function ($phoneNumber) {
            if (!is_string($phoneNumber)) {
                throw new Exception('Input must be a string');
            }

            // Hapus karakter selain angka
            $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

            // Jika nomor dimulai dengan '08', ganti dengan '628'
            if (Str::startsWith($phoneNumber, '08')) {
                $phoneNumber = '628' . substr($phoneNumber, 2);
            }

            // Jika nomor sudah dimulai dengan '628', biarkan apa adanya
            return $phoneNumber;
        });
    }
}
