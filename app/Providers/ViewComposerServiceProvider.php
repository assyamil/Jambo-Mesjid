<?php

namespace App\Providers;

use App\Models\ProfileContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                // Ambil semua data SEKALI
                $contents = ProfileContent::whereIn('key', [
                    'footer_about',
                    'village_name',
                    'kepala_desa',
                    'contact_address',
                    'site_logo',
                    'brand_primary_color_hsl',
                    'brand_secondary_color_hsl',
                    'brand_accent_color_hsl',
                    'social_media_facebook',
                    'social_media_instagram',
                    'social_media_twitter',
                    'social_media_tiktok',
                ])->get()->keyBy('key');

                $view->with([
                    'footerAbout'           => $contents['footer_about'] ?? null,
                    'villageName'           => $contents['village_name'] ?? null,
                    'profileKepalaDesa'     => $contents['kepala_desa'] ?? null,
                    'contactAddress'        => $contents['contact_address'] ?? null,
                    'siteLogo'              => $contents['site_logo'] ?? null,
                    'brandPrimaryColor'     => $contents['brand_primary_color_hsl'] ?? null,
                    'brandSecondaryColor'   => $contents['brand_secondary_color_hsl'] ?? null,
                    'brandAccentColor'      => $contents['brand_accent_color_hsl'] ?? null,
                    'socialMediaFacebook'   => $contents['social_media_facebook'] ?? null,
                    'socialMediaInstagram'  => $contents['social_media_instagram'] ?? null,
                    'socialMediaTwitter'    => $contents['social_media_twitter'] ?? null,
                    'socialMediaTiktok'     => $contents['social_media_tiktok'] ?? null,
                ]);
            } catch (\Throwable $e) {
                // Log error tapi JANGAN crash website
                Log::error('ViewComposerServiceProvider error: '.$e->getMessage());

                // Fallback aman
                $view->with([
                    'footerAbout'           => null,
                    'villageName'           => null,
                    'profileKepalaDesa'     => null,
                    'contactAddress'        => null,
                    'siteLogo'              => null,
                    'brandPrimaryColor'     => null,
                    'brandSecondaryColor'   => null,
                    'brandAccentColor'      => null,
                    'socialMediaFacebook'   => null,
                    'socialMediaInstagram'  => null,
                    'socialMediaTwitter'    => null,
                    'socialMediaTiktok'     => null,
                ]);
            }
        });
    }
}
