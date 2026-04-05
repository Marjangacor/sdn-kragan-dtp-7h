<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SDN Kragan | Sekolah Dasar Negeri</title>
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 text-slate-900">
        @include('home.header')
        <main class="relative overflow-hidden">
            @include('home.hero')
            <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
                @include('home.about')
            </section>
            <section class="bg-white py-16 lg:py-24">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    @include('home.vision-mission')
                </div>
            </section>
            <section class="mx-auto max-w-7xl px-6 py-16 lg:px-8">
                @include('home.profile')
            </section>
            <section class="bg-slate-900 py-16 text-white lg:py-24">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    @include('home.philosophy')
                </div>
            </section>
        </main>
        @include('home.footer')
    </body>
</html>
