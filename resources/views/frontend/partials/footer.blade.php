{{-- resources/views/frontend/partials/footer.blade.php --}}
<footer class="bg-gray-900 text-gray-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">

        {{-- PROFIL DESA --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">
                {{ $villageName->content ?? 'Desa Jambo Mesjid' }}
            </h3>
            <p class="text-sm leading-relaxed">
                Website resmi desa sebagai pusat informasi, layanan publik,
                dan transparansi pemerintahan desa.
            </p>
        </div>

        {{-- MENU --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Menu</h3>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                <li><a href="{{ route('news') }}" class="hover:text-white">Berita</a></li>
                <li><a href="{{ route('gallery') }}" class="hover:text-white">Galeri</a></li>
                <li><a href="{{ route('potentials') }}" class="hover:text-white">Potensi</a></li>
                <li><a href="{{ route('products') }}" class="hover:text-white">Produk Desa</a></li>
            </ul>
        </div>

        {{-- KONTAK --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Kontak</h3>
            <ul class="text-sm space-y-2">
                <li>📍 {{ $villageAddress->content ?? 'Alamat desa belum diatur' }}</li>
                <li>📞 {{ $villagePhone->content ?? '-' }}</li>
                <li>✉️ {{ $villageEmail->content ?? '-' }}</li>
            </ul>
        </div>

    </div>

    <div class="border-t border-gray-700 text-center py-4 text-sm text-gray-400">
        © {{ date('Y') }} {{ $villageName->content ?? 'Desa Jambo Mesjid' }}.
        All rights reserved.
    </div>
</footer>
