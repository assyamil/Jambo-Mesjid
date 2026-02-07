<footer class="bg-soft-gray text-dark-text py-12 mt-12 border-t border-gray-300">
    @php
        use Illuminate\Support\Facades\Schema;
        use App\Models\ProfileContent;

        // ================= DEFAULT AMAN =================
        $contactAddress = null;
        $contactEmail   = null;
        $contactPhone   = null;

        $socialMediaFacebook  = null;
        $socialMediaInstagram = null;
        $socialMediaTwitter   = null;
        $socialMediaTiktok    = null;

        $cleanPhone = null;

        // ================= CEK TABEL =================
        if (Schema::hasTable('profile_contents')) {
            $contactAddress = ProfileContent::where('key', 'contact_address')->first();
            $contactEmail   = ProfileContent::where('key', 'contact_email')->first();
            $contactPhone   = ProfileContent::where('key', 'contact_phone')->first();

            $socialMediaFacebook  = ProfileContent::where('key', 'social_facebook')->first();
            $socialMediaInstagram = ProfileContent::where('key', 'social_instagram')->first();
            $socialMediaTwitter   = ProfileContent::where('key', 'social_twitter')->first();
            $socialMediaTiktok    = ProfileContent::where('key', 'social_tiktok')->first();

            $cleanPhone = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
        }
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- Kolom 1 --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-primary">
                    {{ strip_tags(optional($villageName)->content ?? 'Nama Desa') }}
                </h3>
                <p class="text-sm leading-relaxed text-dark-text/80">
                    {!! optional($footerAbout)->content ?? 'Teks tentang desa belum diatur.' !!}
                </p>
            </div>

            {{-- Kolom 2 --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}">Visi & Misi</a></li>
                    <li><a href="{{ route('potentials') }}">Potensi Desa</a></li>
                    <li><a href="{{ route('news') }}">Berita</a></li>
                    <li><a href="{{ route('gallery') }}">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3 --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('online-services') }}">Layanan Online</a></li>
                    <li><a href="{{ route('service-procedures') }}">Prosedur Layanan</a></li>
                    <li><a href="{{ route('documents') }}">Dokumen Publik</a></li>
                    <li><a href="{{ route('login') }}">Login Admin</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Kontak</h4>

                <div class="text-sm space-y-2 text-dark-text/80">
                    <p>
                        <strong>Alamat:</strong><br>
                        {{ strip_tags($contactAddress->content ?? 'Alamat belum diatur.') }}
                    </p>

                    <p>
                        <strong>Email:</strong><br>
                        {{ $contactEmail->content ?? 'Email belum diatur.' }}
                    </p>

                    <p>
                        <strong>Telepon:</strong><br>
                        @if($cleanPhone)
                            <a href="tel:{{ $cleanPhone }}" class="underline">
                                {{ $contactPhone->content }}
                            </a>
                        @else
                            Telepon belum diatur.
                        @endif
                    </p>
                </div>

                {{-- Sosial Media --}}
                <div class="flex space-x-4 mt-4 text-xl">
                    @if(optional($socialMediaFacebook)->content)
                        <a href="{{ $socialMediaFacebook->content }}" target="_blank">FB</a>
                    @endif
                    @if(optional($socialMediaInstagram)->content)
                        <a href="{{ $socialMediaInstagram->content }}" target="_blank">IG</a>
                    @endif
                    @if(optional($socialMediaTwitter)->content)
                        <a href="{{ $socialMediaTwitter->content }}" target="_blank">X</a>
                    @endif
                    @if(optional($socialMediaTiktok)->content)
                        <a href="{{ $socialMediaTiktok->content }}" target="_blank">TT</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-12 pt-6 border-t border-gray-300 text-center text-xs">
        &copy; {{ date('Y') }} {{ strip_tags(optional($villageName)->content ?? 'Nama Desa') }}
    </div>
</footer>
