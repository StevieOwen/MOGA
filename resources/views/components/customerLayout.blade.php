<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Centre de Formation MOGA Initiative</title>
    <meta
        name="description"
        content="Centre de Formation MOGA Initiative — Former la jeunesse, Construire le pays."
    >

    <!-- =========================================================
         TAILWIND CSS
         Configuration prévue pour un build Tailwind local.
         Les classes utilisées dans cette page seront compilées
         dans css/style.css.
    ========================================================== -->
    <link rel="stylesheet" href="css/style.css">
    @vite('resources/css/app.css')

    <!-- =========================================================
         FONT AWESOME
    ========================================================== -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

    <!-- =========================================================
         NAVIGATION
    ========================================================== -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex h-20 items-center justify-between">

                <!-- Logo -->
                <a href="#accueil" class="flex items-center gap-3">
                     <img
                        src="{{ asset('images/logo-moga.jpeg') }}"
                        alt="MOGA Initiative Logo"
                        class="h-12 w-auto object-contain sm:h-14"
                    >

                    <div class="leading-tight">
                        <div class="text-lg font-extrabold tracking-tight text-[#26295C]">
                            MOGA
                        </div>
                        <div class="hidden text-xs font-medium text-slate-500 sm:block">
                            Former la jeunesse, Construire le pays
                        </div>
                    </div>
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden items-center gap-7 lg:flex">
                    <a
                        href="{{route('/')}}"
                        class="text-sm font-semibold text-[#26295C] transition hover:text-[#8C4B31]"
                    >
                        Accueil
                    </a>

                    <a
                        href="{{ route('customer.formations.index') }}"
                        class="text-sm font-semibold text-slate-600 transition hover:text-[#8C4B31]"
                    >
                        Catalogue des formations
                    </a>

                    <a
                        href="{{ route('customer.annonces.index') }}"
                        class="text-sm font-semibold text-slate-600 transition hover:text-[#8C4B31]"
                    >
                        Annonces
                    </a>

                    <a
                        href="#contact"
                        class="text-sm font-semibold text-slate-600 transition hover:text-[#8C4B31]"
                    >
                        Contact & Candidature
                    </a>
                </nav>

                <!-- CTA Desktop -->
                <div class="hidden lg:block">
                    <a
                        href="#contact"
                        class="inline-flex items-center gap-2 rounded-lg bg-[#26295C] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#1d2049]"
                    >
                        <i class="fa-solid fa-arrow-right"></i>
                        S'inscrire / Postuler
                    </a>
                </div>

                <!-- Burger -->
                <button
                    id="mobile-menu-button"
                    type="button"
                    class="inline-flex h-11 w-11 items-center justify-center rounded-lg border border-slate-200 text-[#26295C] transition hover:bg-slate-100 lg:hidden"
                    aria-label="Ouvrir le menu"
                    aria-expanded="false"
                >
                    <i id="menu-icon" class="fa-solid fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Navigation Mobile -->
            <div
                id="mobile-menu"
                class="hidden border-t border-slate-100 py-5 lg:hidden"
            >
                <nav class="flex flex-col gap-1">

                    <a
                        href="#accueil"
                        class="rounded-lg px-4 py-3 text-sm font-semibold text-[#26295C] hover:bg-slate-50"
                    >
                        Accueil
                    </a>

                    <a
                        href="#formations"
                        class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                    >
                        Catalogue des formations
                    </a>

                    <a
                        href="#apropos"
                        class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                    >
                        À propos & Impact
                    </a>

                    <a
                        href="#contact"
                        class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                    >
                        Contact & Candidature
                    </a>

                    <a
                        href="#contact"
                        class="mt-3 inline-flex items-center justify-center gap-2 rounded-lg bg-[#26295C] px-5 py-3 text-sm font-bold text-white"
                    >
                        <i class="fa-solid fa-arrow-right"></i>
                        S'inscrire / Postuler
                    </a>
                </nav>
            </div>
        </div>
    </header>

    {{$slot}}


</body>
</html>