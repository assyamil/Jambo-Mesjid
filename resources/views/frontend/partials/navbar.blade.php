{{-- resources/views/frontend/partials/navbar.blade.php --}}
@php
    use Illuminate\Support\Str;
@endphp

<nav
    x-data="{ open: false }"
    class="sticky top-0 z-50 shadow-lg bg-[linear-gradient(135deg,var(--color-primary)_0%,var(--color-secondary)_50%,var(--color-accent)_100%)]">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                @php
                    $logoContent = $siteLogo->content ?? 'images/logo.jpg';
                @endphp

                <img
                    src="{{ Str::contains($logoContent, 'images') ? asset($logoContent) : asset('storage/'.$logoContent) }}"
                    alt="Logo"
                    class="h-8 w-auto">

                <span class="text-white font-semibold text-lg">
                    {{ $villageName->content ?? 'Nama Desa' }}
                </span>
            </a>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex gap-6 items-center">
                <a href="{{ route('home') }}" class="text-white hover:text-yellow-200">Beranda</a>
                <a href="{{ route('news') }}" class="text-white hover:text-yellow-200">Berita</a>
                <a href="{{ route('gallery') }}" class="text-white hover:text-yellow-200">Galeri</a>
                <a href="{{ route('potentials') }}" class="text-white hover:text-yellow-200">Potensi</a>
                <a href="{{ route('products') }}" class="text-white hover:text-yellow-200">Produk</a>
            </div>

            {{-- MOBILE BUTTON --}}
            <button @click="open = !open" class="md:hidden text-white">
                ☰
            </button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" class="md:hidden bg-primary-dark px-4 pb-4">
        <a href="{{ route('home') }}" class="block py-2 text-white">Beranda</a>
        <a href="{{ route('news') }}" class="block py-2 text-white">Berita</a>
        <a href="{{ route('gallery') }}" class="block py-2 text-white">Galeri</a>
        <a href="{{ route('potentials') }}" class="block py-2 text-white">Potensi</a>
        <a href="{{ route('products') }}" class="block py-2 text-white">Produk</a>
    </div>
</nav>
