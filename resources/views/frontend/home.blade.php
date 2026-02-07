@extends('layouts.frontend')

@section('content')

{{-- ================= HERO SLIDER ================= --}}
@php
    $safeSliders = $sliders ?? collect();
@endphp

<div class="relative w-full overflow-hidden h-screen"
     x-data="{
        activeSlide: 0,
        slides: @js($safeSliders->values())
     }"
     x-init="if (slides.length > 1) {
        setInterval(() => activeSlide = (activeSlide + 1) % slides.length, 5000)
     }">

    @forelse ($safeSliders as $index => $slider)
        <div x-show="activeSlide === {{ $index }}"
             x-transition
             class="absolute inset-0 bg-cover bg-center flex items-center justify-center"
             style="background-image:url('{{ $slider->image ? Storage::url($slider->image) : '' }}')">

            <div class="absolute inset-0 bg-black/60"></div>

            <div class="relative z-10 text-center max-w-2xl px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    {{ $slider->title ?? '' }}
                </h1>
                <p class="text-white/90">
                    {{ $slider->description ?? '' }}
                </p>
            </div>
        </div>
    @empty
        <div class="h-screen flex items-center justify-center text-gray-500">
            Tidak ada slider
        </div>
    @endforelse
</div>

{{-- ================= SAMBUTAN ================= --}}
<section class="py-16 bg-white text-center">
    <h2 class="text-4xl font-bold text-accent mb-6">
        Selamat Datang di {{ optional($villageName)->content ?? 'Desa Kami' }}
    </h2>

    <p class="max-w-3xl mx-auto text-gray-600">
        {!! optional($sekilasDesa)->content ?? 'Konten belum tersedia.' !!}
    </p>
</section>

{{-- ================= POTENSI ================= --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Potensi Desa</h2>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse ($potentials ?? collect() as $pot)
                <div class="bg-white rounded shadow overflow-hidden">
                    @if (!empty($pot->image))
                        <img src="{{ Storage::url($pot->image) }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-5">
                        <h3 class="font-semibold text-lg mb-2">
                            {{ $pot->title ?? '-' }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {!! \Illuminate\Support\Str::limit($pot->description ?? '', 100) !!}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Data potensi belum tersedia.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= BERITA ================= --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Berita Terbaru</h2>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse ($news ?? collect() as $n)
                <div class="bg-gray-50 rounded shadow overflow-hidden">
                    @if (!empty($n->image_url))
                        <img src="{{ $n->image_url }}" class="h-48 w-full object-cover">
                    @endif
                    <div class="p-5">
                        <h3 class="font-semibold mb-2">
                            <a href="{{ route('news.show', $n->slug) }}" class="hover:text-accent">
                                {{ \Illuminate\Support\Str::limit($n->title ?? '', 60) }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ \Illuminate\Support\Str::limit(strip_tags($n->content ?? ''), 100) }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Belum ada berita.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= GALERI ================= --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
            Galeri {{ optional($villageName)->content ?? '' }}
        </h2>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse ($homepageGalleries ?? collect() as $gallery)
                @php
                    $img = $gallery->cover_image
                        ?? optional($gallery->images->first())->path;
                @endphp

                <div class="bg-white rounded shadow overflow-hidden">
                    @if ($img)
                        <img src="{{ Storage::url($img) }}" class="h-64 w-full object-cover">
                    @endif

                    <div class="p-4">
                        <h4 class="font-semibold">
                            {{ $gallery->name ?? '-' }}
                        </h4>
                        <p class="text-sm text-gray-500">
                            {{ optional($gallery->images)->count() ?? 0 }} Foto
                        </p>
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Galeri belum tersedia.
                </p>
            @endforelse
        </div>
    </div>
</section>

{{-- ================= MAP ================= --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Lokasi Kantor Desa</h2>

        @if (!empty($googleMapsEmbedUrl))
            <iframe
                src="{{ $googleMapsEmbedUrl }}"
                class="w-full h-96 rounded border"
                loading="lazy">
            </iframe>
        @else
            <p class="text-center text-gray-500">
                Lokasi belum diatur.
            </p>
        @endif
    </div>
</section>

@endsection
