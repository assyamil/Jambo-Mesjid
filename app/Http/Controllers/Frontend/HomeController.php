<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

use App\Models\HeroSlider;
use App\Models\Potential;
use App\Models\News;
use App\Models\Gallery;
use App\Models\ProfileContent;

class HomeController extends Controller
{
    public function index()
    {
        // Default aman
        $sliders = collect();
        $potentials = collect();
        $news = collect();
        $homepageGalleries = collect();

        $sekilasDesa = null;
        $contactAddress = null;
        $contactPhone = null;
        $contactEmail = null;
        $villageName = null;
        $googleMapsEmbedUrl = null;

        // ================= HERO SLIDER =================
        if (Schema::hasTable('hero_sliders')) {
            $sliders = HeroSlider::where('is_active', true)
                ->orderBy('order')
                ->get();
        }

        // ================= POTENTIAL =================
        if (Schema::hasTable('potentials')) {
            $potentials = Potential::where('is_published', true)
                ->orderBy('order')
                ->take(3)
                ->get();
        }

        // ================= NEWS =================
        if (Schema::hasTable('news')) {
            $news = News::where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->withCount('comments')
                ->get();
        }

        // ================= GALLERY =================
        if (Schema::hasTable('galleries')) {
            $homepageGalleries = Gallery::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->with('images')
                ->get();
        }

        // ================= PROFILE CONTENT =================
        if (Schema::hasTable('profile_contents')) {

            $sekilasDesa = ProfileContent::where('key', 'sekilas_desa')->first();
            $contactAddress = ProfileContent::where('key', 'contact_address')->first();
            $contactPhone = ProfileContent::where('key', 'contact_phone')->first();
            $contactEmail = ProfileContent::where('key', 'contact_email')->first();
            $villageName = ProfileContent::where('key', 'village_name')->first();

            // -------- GOOGLE MAPS (LAT & LNG) --------
            $latContent = ProfileContent::where('key', 'Maps_latitude')->first();
            $lngContent = ProfileContent::where('key', 'Maps_longitude')->first();

            if (
                $latContent && !empty($latContent->content) &&
                $lngContent && !empty($lngContent->content)
            ) {
                $lat = $latContent->content;
                $lng = $lngContent->content;

                $googleMapsEmbedUrl = "https://maps.google.com/maps?q={$lat},{$lng}&hl=id&z=15&output=embed";
            }
        }

        return view('frontend.home', compact(
            'sliders',
            'potentials',
            'news',
            'homepageGalleries',
            'sekilasDesa',
            'contactAddress',
            'contactPhone',
            'contactEmail',
            'googleMapsEmbedUrl',
            'villageName'
        ));
    }
}
