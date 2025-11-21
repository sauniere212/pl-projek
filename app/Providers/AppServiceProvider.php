<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $storagePath = storage_path('app/public');
        $publicPath = public_path('storage');

        if (! is_link($publicPath)) {
            if (file_exists($publicPath) && ! is_link($publicPath)) {
                app('files')->delete($publicPath);
            }

            try {
                app('files')->link($storagePath, $publicPath);
            } catch (\Throwable $e) {
                Log::error('Gagal membuat symbolic link storage.', [
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }
}
