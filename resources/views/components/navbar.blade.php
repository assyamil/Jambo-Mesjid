@php
    use Illuminate\Support\Str;

    $village = optional($villageName)->content ?? 'Nama Desa';
    $logo    = optional($siteLogo)->content ?? 'images/logo.jpg';
@endphp

<nav x-data="{ open:false }"
    class="sticky top-0 z-50 shadow-lg bg-[linear-gradient(135deg,var(--color-primary)_0%,var(--color-secondary)_50%,var(--color-accent)_100%)]">

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img
                    src="{{ Str::contains($logo,'images') ? asset($logo) : asset('storage/'.$logo) }}"
                    class="h-8 w-auto"
                    alt="Logo {{ $village }}">
                <span class="text-white text-lg font-semibold whitespace-nowrap">
                    {{ $village }}
                </span>
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex gap-6 items-center text-white font-semibold">
                <a href="{{ route('home') }}" class="hover:text-yellow-200">Beranda</a>

                {{-- PROFIL --}}
                <div class="relative" x-data="{show:false}" @mouseenter="show=true" @mouseleave="show=false">
                    <button class="hover:text-yellow-200">Profil Desa</button>
                    <div x-show="show" x-transition
                        class="absolute mt-2 bg-white rounded shadow w-48 text-gray-700">
                        <a href="{{ route('profil.visi') }}" class="block px-4 py-2 hover:bg-gray-100">Visi & Misi</a>
                        <a href="{{ route('profil.sejarah') }}" class="block px-4 py-2 hover:bg-gray-100">Sejarah Desa</a>
                        <a href="{{ route('profil.struktur') }}" class="block px-4 py-2 hover:bg-gray-100">Struktur Pemerintahan</a>
                    </div>
                </div>

                {{-- LAYANAN --}}
                <div class="relative" x-data="{show:false}" @mouseenter="show=true" @mouseleave="show=false">
                    <button class="hover:text-yellow-200">Layanan</button>
                    <div x-show="show" x-transition
                        class="absolute mt-2 bg-white rounded shadow w-56 text-gray-700">
                        <a href="{{ route('service-procedures') }}" class="block px-4 py-2 hover:bg-gray-100">Prosedur Layanan</a>
                        <a href="{{ route('documents') }}" class="block px-4 py-2 hover:bg-gray-100">Dokumen Desa</a>
                        <a href="{{ route('surat.public.create') }}" class="block px-4 py-2 hover:bg-gray-100">Ajukan Surat</a>
                    </div>
                </div>

                <a href="{{ route('potentials') }}" class="hover:text-yellow-200">Potensi</a>
                <a href="{{ route('news') }}" class="hover:text-yellow-200">Berita</a>
                <a href="{{ route('gallery') }}" class="hover:text-yellow-200">Galeri</a>
                <a href="{{ route('institutions.index') }}" class="hover:text-yellow-200">Lembaga</a>
                <a href="{{ route('products') }}" class="hover:text-yellow-200">Produk</a>
            </div>

            {{-- MOBILE BUTTON --}}
            <button @click="open=!open" class="md:hidden text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" x-transition class="md:hidden bg-primary text-white px-4 py-4 space-y-2">
        <a href="{{ route('home') }}" class="block">Beranda</a>
        <a href="{{ route('profil.visi') }}" class="block">Profil Desa</a>
        <a href="{{ route('service-procedures') }}" class="block">Layanan</a>
        <a href="{{ route('potentials') }}" class="block">Potensi</a>
        <a href="{{ route('news') }}" class="block">Berita</a>
        <a href="{{ route('gallery') }}" class="block">Galeri</a>
        <a href="{{ route('products') }}" class="block">Produk</a>
        <a href="{{ route('institutions.index') }}" class="block">Lembaga</a>
    </div>

</nav>
