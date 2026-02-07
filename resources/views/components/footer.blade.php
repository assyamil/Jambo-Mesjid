<footer class="bg-soft-gray text-dark-text py-12 mt-12 border-t border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Kolom 1: Tentang Desa --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-primary">
                    {{ strip_tags(optional($villageName)->content ?? 'Nama Desa') }}
                </h3>
                <p class="text-sm leading-relaxed text-dark-text/80">
                    {!! optional($footerAbout)->content ?? 'Teks tentang desa belum diatur di admin.' !!}
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-primary-dark">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}" class="hover:text-primary-dark">Visi & Misi</a></li>
                    <li><a href="{{ route('potentials') }}" class="hover:text-primary-dark">Potensi Desa</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-primary-dark">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-primary-dark">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('online-services') }}" class="hover:text-primary-dark">Layanan Online</a></li>
                    <li><a href="{{ route('service-procedures') }}" class="hover:text-primary-dark">Prosedur Layanan</a></li>
                    <li><a href="{{ route('documents') }}" class="hover:text-primary-dark">Dokumen Publik</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-primary-dark">Login Admin</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Kontak</h4>

                @php
                    $contactAddress = App\Models\ProfileContent::where('key', 'contact_address')->first();
                    $contactEmail   = App\Models\ProfileContent::where('key', 'contact_email')->first();
                    $contactPhone   = App\Models\ProfileContent::where('key', 'contact_phone')->first();

                    $cleanPhone = preg_replace('/[^0-9+]/', '', optional($contactPhone)->content ?? '');
                @endphp

                <div class="text-sm space-y-2 text-dark-text/80">
                    <p>
                        <strong>Alamat:</strong><br>
                        {{ strip_tags(optional($contactAddress)->content ?? 'Alamat belum diatur.') }}
                    </p>

                    <p>
                        <strong>Email:</strong><br>
                        @if(optional($contactEmail)->content)
                            <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                               class="underline hover:text-primary-dark">
                                {{ strip_tags($contactEmail->content) }}
                            </a>
                        @else
                            Email belum diatur.
                        @endif
                    </p>

                    <p>
                        <strong>Telepon:</strong><br>
                        @if(optional($contactPhone)->content)
                            <a href="tel:{{ $cleanPhone }}"
                               class="underline hover:text-primary-dark">
                                {{ strip_tags($contactPhone->content) }}
                            </a>
                        @else
                            Telepon belum diatur.
                        @endif
                    </p>
                </div>

                {{-- Media Sosial --}}
                <div class="flex space-x-4 mt-4 text-xl">

                    @if(optional($socialMediaFacebook)->content)
                        <a href="{{ $socialMediaFacebook->content }}" target="_blank" class="text-blue-500 hover:scale-110 transition">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 320 512"><path d="M279.14 288l14.22-92.66h-88.91V127.91c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S293.1 0 259.36 0C194.65 0 150.27 42.42 150.27 119.44V195.3H69.09V288h81.18v224h100.2V288z"/></svg>
                        </a>
                    @endif

                    @if(optional($socialMediaInstagram)->content)
                        <a href="{{ $socialMediaInstagram->content }}" target="_blank" class="text-pink-500 hover:scale-110 transition">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9 114.9-51.3 114.9-114.9S287.7 141 224.1 141z"/></svg>
                        </a>
                    @endif

                    @if(optional($socialMediaTwitter)->content)
                        <a href="{{ $socialMediaTwitter->content }}" target="_blank" class="text-sky-500 hover:scale-110 transition">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 512 512"><path d="M459.4 151.7c.3 4.5.3 9.1.3 13.6 0 138.7-105.6 298.8-298.8 298.8"/></svg>
                        </a>
                    @endif

                    @if(optional($socialMediaTiktok)->content)
                        <a href="{{ $socialMediaTiktok->content }}" target="_blank" class="text-gray-800 hover:scale-110 transition">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 448 512"><path d="M448,209.8v95.5c-37.1,0-73.1-10.6-104.5-30.5"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Bawah --}}
    <div class="mt-12 pt-6 border-t border-gray-300 text-center text-xs text-dark-text/90">
        <p>
            &copy; {{ date('Y') }}
            {{ strip_tags(optional($villageName)->content ?? 'Nama Desa') }}.
            Hak Cipta Dilindungi.
        </p>
        <p class="mt-1 italic">
            Versi {{ config('app.version', '1.0.0') }} |
            Dibuat oleh <span class="text-primary font-medium">NanuTech Solution</span>
        </p>
    </div>
</footer>
