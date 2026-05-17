@props([
    'title' => 'SDN Kragan',
    'subtitle' => 'Sekolah Dasar Negeri',
    'description' => 'Mewujudkan generasi cerdas, berkarakter, dan berprestasi melalui pendidikan yang berkualitas dan humanis.',
    'quickLinks' => [],
])

@php
    $links = count($quickLinks) > 0
        ? $quickLinks
        : [
            ['label' => 'Visi & Misi', 'href' => '#visi-misi'],
            ['label' => 'Prestasi', 'href' => '#profil'],
            ['label' => 'Filosofi Logo', 'href' => '#filosofi'],
        ];
@endphp

<footer id="kontak" class="footer-wrap text-white">
    <div class="mx-auto grid max-w-7xl gap-8 px-6 py-12 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
        <div class="space-y-5 reveal js-card">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-upt-sdn-kragan.png') }}" alt="Logo SDN Kragan" class="school-logo-img school-logo-img--footer" />
                <div>
                    <p class="text-base font-semibold text-white">{{ $title }}</p>
                    <p class="text-xs text-white">{{ $subtitle }}</p>
                </div>
            </div>
            <p class="max-w-md text-sm leading-7 text-white">{{ $description }}</p>
        </div>
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="reveal js-card" style="--reveal-delay: 80ms">
                <h3 class="text-sm font-semibold text-white">Tautan Cepat</h3>
                <ul class="space-y-3 list-disc pl-5 text-white marker:text-white">
                    @foreach ($links as $link)
                        <li><a href="{{ $link['href'] }}" class="hover:text-white">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="reveal js-card" style="--reveal-delay: 160ms">
                <h3 class="text-sm font-semibold text-white">Kontak</h3>
                <div class="mt-3 space-y-2 text-sm text-white">
                    <p>Jl. Pendidikan No. 12, Kragan, Rembang</p>
                    <p>+62 318913900</p>
                    <p>info@sdnkragan.sch.id</p>
                </div>
            </div>
        </div>
    </div>
    <div class="border-t border-white/15 py-4 text-center text-xs text-white">© 2026 SDN Kragan. All rights reserved.</div>
</footer>
