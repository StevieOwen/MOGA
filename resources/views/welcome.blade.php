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
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-lg bg-[#26295C] text-white shadow-sm"
                    >
                        <i class="fa-solid fa-building-columns text-xl"></i>
                    </div>

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
                        href="#accueil"
                        class="text-sm font-semibold text-[#26295C] transition hover:text-[#8C4B31]"
                    >
                        Accueil
                    </a>

                    <a
                        href="#formations"
                        class="text-sm font-semibold text-slate-600 transition hover:text-[#8C4B31]"
                    >
                        Catalogue des formations
                    </a>

                    <a
                        href="#apropos"
                        class="text-sm font-semibold text-slate-600 transition hover:text-[#8C4B31]"
                    >
                        À propos & Impact
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


    <main>

        <!-- =====================================================
             HERO SECTION
        ====================================================== -->
        <section
            id="accueil"
            class="relative isolate overflow-hidden bg-white"
        >

            <!-- Motif blueprint discret -->
            <div
                class="pointer-events-none absolute inset-0 opacity-40"
                aria-hidden="true"
            >
                <div
                    class="absolute inset-0"
                    style="background-image: linear-gradient(to right, #e2e8f0 1px, transparent 1px), linear-gradient(to bottom, #e2e8f0 1px, transparent 1px); background-size: 55px 55px;"
                ></div>
            </div>

            <!-- Formes géométriques -->
            <div
                class="pointer-events-none absolute -right-32 top-20 h-96 w-96 rounded-full border-[40px] border-[#26295C]/5"
            ></div>

            <div
                class="pointer-events-none absolute -left-20 bottom-0 h-64 w-64 rounded-full border-[25px] border-[#8C4B31]/5"
            ></div>

            <div class="relative mx-auto max-w-7xl px-4 py-20 sm:px-6 sm:py-24 lg:px-8 lg:py-28">

                <div class="grid items-center gap-14 lg:grid-cols-2">

                    <!-- Texte -->
                    <div class="max-w-2xl">

                        <div
                            class="mb-6 inline-flex items-center gap-2 rounded-full border border-[#26295C]/10 bg-[#26295C]/5 px-4 py-2 text-sm font-bold text-[#26295C]"
                        >
                            <span class="h-2 w-2 rounded-full bg-[#8C4B31]"></span>
                            Centre de Formation MOGA Initiative
                        </div>

                        <h1
                            class="text-4xl font-black leading-tight tracking-tight text-[#26295C] sm:text-5xl lg:text-6xl"
                        >
                            Former la jeunesse,
                            <span class="text-[#8C4B31]">
                                Construire le pays.
                            </span>
                        </h1>

                        <p
                            class="mt-6 max-w-xl text-base leading-8 text-slate-600 sm:text-lg"
                        >
                            Développement des compétences techniques,
                            professionnelles et humaines des étudiants,
                            jeunes diplômés et jeunes professionnels.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                            <a
                                href="#formations"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#26295C] px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#26295C]/10 transition hover:bg-[#1d2049]"
                            >
                                Découvrir nos formations
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>

                            <a
                                href="#contact"
                                class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#26295C]/20 bg-white px-6 py-3.5 text-sm font-bold text-[#26295C] transition hover:border-[#8C4B31] hover:text-[#8C4B31]"
                            >
                                Rejoindre l'aventure
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>

                        </div>

                        <!-- Mini indicateurs -->
                        <div class="mt-10 grid max-w-lg grid-cols-2 gap-6 border-t border-slate-200 pt-7 sm:grid-cols-3">

                            <div>
                                <p class="text-2xl font-black text-[#26295C]">
                                    100%
                                </p>
                                <p class="mt-1 text-xs font-medium text-slate-500">
                                    Orienté pratique
                                </p>
                            </div>

                            <div>
                                <p class="text-2xl font-black text-[#26295C]">
                                    4
                                </p>
                                <p class="mt-1 text-xs font-medium text-slate-500">
                                    Étapes de parcours
                                </p>
                            </div>

                            <div>
                                <p class="text-2xl font-black text-[#26295C]">
                                    MOGA
                                </p>
                                <p class="mt-1 text-xs font-medium text-slate-500">
                                    Initiative jeunesse
                                </p>
                            </div>

                        </div>
                    </div>


                    <!-- Illustration Génie Civil -->
                    <div class="relative mx-auto w-full max-w-xl">

                        <div
                            class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-xl"
                        >

                            <!-- Blueprint -->
                            <div
                                class="absolute inset-0 opacity-50"
                                aria-hidden="true"
                                style="background-image: linear-gradient(to right, #cbd5e1 1px, transparent 1px), linear-gradient(to bottom, #cbd5e1 1px, transparent 1px); background-size: 30px 30px;"
                            ></div>

                            <div class="relative">

                                <!-- Entête illustration -->
                                <div class="mb-6 flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[#8C4B31]">
                                            MOGA / STRUCTURE
                                        </p>
                                        <p class="mt-1 text-sm font-semibold text-[#26295C]">
                                            Learning Blueprint
                                        </p>
                                    </div>

                                    <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                        <i class="fa-solid fa-helmet-safety"></i>
                                    </div>
                                </div>

                                <!-- Construction illustration -->
                                <div class="relative h-72 overflow-hidden rounded-2xl bg-white/80 p-5">

                                    <!-- Sol -->
                                    <div class="absolute bottom-8 left-5 right-5 h-1 bg-[#26295C]/20"></div>

                                    <!-- Tour -->
                                    <div class="absolute bottom-9 left-1/2 -translate-x-1/2">

                                        <!-- Tour principale -->
                                        <div class="relative flex h-48 w-32 items-end justify-center border-x-4 border-[#26295C]">

                                            <!-- Barres horizontales -->
                                            <div class="absolute left-0 right-0 top-8 h-1 bg-[#8C4B31]"></div>
                                            <div class="absolute left-0 right-0 top-20 h-1 bg-[#8C4B31]"></div>
                                            <div class="absolute left-0 right-0 top-32 h-1 bg-[#8C4B31]"></div>
                                            <div class="absolute left-0 right-0 top-44 h-1 bg-[#8C4B31]"></div>

                                            <!-- Diagonales -->
                                            <div class="absolute inset-0">
                                                <div class="absolute left-2 top-2 h-52 w-1 rotate-[35deg] bg-[#26295C]/60 origin-top"></div>
                                                <div class="absolute right-2 top-2 h-52 w-1 -rotate-[35deg] bg-[#26295C]/60 origin-top"></div>
                                            </div>

                                            <!-- Sommet -->
                                            <div class="absolute -top-10 left-1/2 h-10 w-1 -translate-x-1/2 bg-[#26295C]"></div>

                                            <div class="absolute -top-14 left-1/2 h-5 w-12 -translate-x-1/2 border-2 border-[#26295C]"></div>
                                        </div>
                                    </div>

                                    <!-- Icône niveau -->
                                    <div class="absolute left-6 top-10 flex h-14 w-14 items-center justify-center rounded-xl border border-slate-200 bg-white shadow-sm">
                                        <i class="fa-solid fa-ruler-combined text-xl text-[#8C4B31]"></i>
                                    </div>

                                    <!-- Icône compas -->
                                    <div class="absolute right-6 top-14 flex h-14 w-14 items-center justify-center rounded-xl border border-slate-200 bg-white shadow-sm">
                                        <i class="fa-solid fa-compass-drafting text-xl text-[#26295C]"></i>
                                    </div>

                                    <!-- Icône structure -->
                                    <div class="absolute bottom-7 right-7 flex h-12 w-12 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31]">
                                        <i class="fa-solid fa-cubes-stacked"></i>
                                    </div>

                                </div>

                                <!-- Tags -->
                                <div class="mt-5 flex flex-wrap gap-2">
                                    <span class="rounded-md bg-[#26295C]/10 px-3 py-1.5 text-xs font-bold text-[#26295C]">
                                        Technique
                                    </span>
                                    <span class="rounded-md bg-[#8C4B31]/10 px-3 py-1.5 text-xs font-bold text-[#8C4B31]">
                                        Professionnel
                                    </span>
                                    <span class="rounded-md bg-slate-200 px-3 py-1.5 text-xs font-bold text-slate-600">
                                        Humain
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        <!-- =====================================================
             À PROPOS
        ====================================================== -->
        <section id="apropos" class="bg-slate-50 py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-3xl text-center">

                    <span class="text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                        À propos de MOGA
                    </span>

                    <h2 class="mt-3 text-3xl font-black tracking-tight text-[#26295C] sm:text-4xl">
                        Construire des compétences,
                        construire des opportunités.
                    </h2>

                    <p class="mt-5 leading-8 text-slate-600">
                        Le Centre de Formation MOGA Initiative accompagne les jeunes
                        dans le développement de compétences directement mobilisables
                        dans leur parcours académique et professionnel.
                    </p>

                </div>


                <!-- Piliers -->
                <div class="mt-14 grid gap-6 md:grid-cols-3">

                    <!-- Pilier 1 -->
                    <article class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                            <i class="fa-solid fa-gears text-xl"></i>
                        </div>

                        <p class="mt-7 text-xs font-bold uppercase tracking-widest text-[#8C4B31]">
                            Pilier 01
                        </p>

                        <h3 class="mt-2 text-xl font-extrabold text-[#26295C]">
                            Savoir-Faire Technique
                        </h3>

                        <p class="mt-4 leading-7 text-slate-600">
                            Maîtrise des outils modernes, technologies,
                            méthodes et compétences techniques adaptées
                            aux exigences du monde professionnel.
                        </p>

                    </article>


                    <!-- Pilier 2 -->
                    <article class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31]">
                            <i class="fa-solid fa-briefcase text-xl"></i>
                        </div>

                        <p class="mt-7 text-xs font-bold uppercase tracking-widest text-[#8C4B31]">
                            Pilier 02
                        </p>

                        <h3 class="mt-2 text-xl font-extrabold text-[#26295C]">
                            Pratique Professionnelle
                        </h3>

                        <p class="mt-4 leading-7 text-slate-600">
                            Gestion de projet, méthodes agiles, communication,
                            culture d'entreprise et mise en situation réelle.
                        </p>

                    </article>


                    <!-- Pilier 3 -->
                    <article class="group rounded-2xl border border-slate-200 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                            <i class="fa-solid fa-people-group text-xl"></i>
                        </div>

                        <p class="mt-7 text-xs font-bold uppercase tracking-widest text-[#8C4B31]">
                            Pilier 03
                        </p>

                        <h3 class="mt-2 text-xl font-extrabold text-[#26295C]">
                            Savoir-Être Humain
                        </h3>

                        <p class="mt-4 leading-7 text-slate-600">
                            Leadership, intelligence émotionnelle, éthique,
                            travail en équipe et développement personnel.
                        </p>

                    </article>

                </div>
            </div>
        </section>


        <!-- =====================================================
             PUBLICS CIBLES
        ====================================================== -->
        <section class="bg-white py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid gap-6 lg:grid-cols-2">

                    <!-- Étudiants -->
                    <article class="relative overflow-hidden rounded-3xl bg-[#26295C] p-8 text-white sm:p-10">

                        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full border-[25px] border-white/5"></div>

                        <div class="relative">

                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-white/10">
                                <i class="fa-solid fa-graduation-cap text-xl"></i>
                            </div>

                            <p class="mt-7 text-sm font-bold uppercase tracking-widest text-white/60">
                                Public 01
                            </p>

                            <h3 class="mt-2 text-2xl font-black">
                                Étudiants & Diplômés
                            </h3>

                            <p class="mt-4 max-w-lg leading-7 text-white/70">
                                Accélérer l'insertion professionnelle grâce à
                                l'apprentissage concret, aux projets pratiques
                                et au développement des compétences recherchées.
                            </p>

                            <ul class="mt-7 space-y-3 text-sm text-white/80">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Apprentissage orienté pratique
                                </li>

                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Préparation au monde professionnel
                                </li>

                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Accompagnement vers l'insertion
                                </li>
                            </ul>

                        </div>
                    </article>


                    <!-- Professionnels -->
                    <article class="relative overflow-hidden rounded-3xl border border-slate-200 bg-slate-50 p-8 sm:p-10">

                        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full border-[25px] border-[#8C4B31]/5"></div>

                        <div class="relative">

                            <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31]">
                                <i class="fa-solid fa-chart-line text-xl"></i>
                            </div>

                            <p class="mt-7 text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                                Public 02
                            </p>

                            <h3 class="mt-2 text-2xl font-black text-[#26295C]">
                                Jeunes Professionnels
                            </h3>

                            <p class="mt-4 max-w-lg leading-7 text-slate-600">
                                Développer rapidement de nouvelles compétences,
                                renforcer son profil professionnel et préparer
                                les prochaines étapes de sa carrière.
                            </p>

                            <ul class="mt-7 space-y-3 text-sm text-slate-600">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Montée en compétences rapide
                                </li>

                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Développement du leadership
                                </li>

                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check mt-0.5 text-[#8C4B31]"></i>
                                    Évolution professionnelle
                                </li>
                            </ul>

                        </div>
                    </article>

                </div>
            </div>
        </section>


        <!-- =====================================================
             FORMATIONS / PARCOURS
        ====================================================== -->
        <section id="formations" class="bg-slate-50 py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="max-w-3xl">

                    <span class="text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                        Notre approche
                    </span>

                    <h2 class="mt-3 text-3xl font-black tracking-tight text-[#26295C] sm:text-4xl">
                        Un parcours pensé comme un projet de construction.
                    </h2>

                    <p class="mt-5 leading-8 text-slate-600">
                        De l'analyse du profil à l'insertion, chaque étape est
                        conçue pour transformer les connaissances en compétences
                        concrètes et valorisables.
                    </p>

                </div>


                <!-- Timeline -->
                <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-4">

                    <!-- Étape 1 -->
                    <article class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <span class="text-4xl font-black text-[#26295C]/10">
                                01
                            </span>

                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </div>

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold text-[#26295C]">
                            Bilans & Profil
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Identifier les besoins, les compétences,
                            les objectifs et le parcours de chaque apprenant.
                        </p>

                    </article>


                    <!-- Étape 2 -->
                    <article class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <span class="text-4xl font-black text-[#26295C]/10">
                                02
                            </span>

                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold text-[#26295C]">
                            Formations
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Acquérir les connaissances et méthodes à travers
                            des formations structurées et orientées pratique.
                        </p>

                    </article>


                    <!-- Étape 3 -->
                    <article class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <span class="text-4xl font-black text-[#26295C]/10">
                                03
                            </span>

                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                <i class="fa-solid fa-diagram-project"></i>
                            </div>

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold text-[#26295C]">
                            Projet Fil-Rouge
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Mettre les acquis en pratique sur un projet concret
                            avec une logique proche du monde professionnel.
                        </p>

                    </article>


                    <!-- Étape 4 -->
                    <article class="relative rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                        <div class="flex items-center justify-between">

                            <span class="text-4xl font-black text-[#26295C]/10">
                                04
                            </span>

                            <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                                <i class="fa-solid fa-certificate"></i>
                            </div>

                        </div>

                        <h3 class="mt-6 text-lg font-extrabold text-[#26295C]">
                            Certification & Insertion
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-slate-600">
                            Valoriser les compétences acquises et faciliter
                            la transition vers les opportunités professionnelles.
                        </p>

                    </article>

                </div>
            </div>
        </section>


        <!-- =====================================================
             STATISTIQUES
        ====================================================== -->
        <section class="bg-[#26295C] py-16">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid gap-8 text-center sm:grid-cols-2 lg:grid-cols-4">

                    <div>
                        <p class="text-4xl font-black text-white">
                            100%
                        </p>
                        <p class="mt-2 text-sm text-white/60">
                            Orienté pratique & insertion
                        </p>
                    </div>

                    <div>
                        <p class="text-4xl font-black text-white">
                            4
                        </p>
                        <p class="mt-2 text-sm text-white/60">
                            Étapes d'accompagnement
                        </p>
                    </div>

                    <div>
                        <p class="text-4xl font-black text-white">
                            3
                        </p>
                        <p class="mt-2 text-sm text-white/60">
                            Piliers de développement
                        </p>
                    </div>

                    <div>
                        <p class="text-4xl font-black text-white">
                            ∞
                        </p>
                        <p class="mt-2 text-sm text-white/60">
                            Potentiel à construire
                        </p>
                    </div>

                </div>

            </div>
        </section>


        <!-- =====================================================
             RÉSEAU D'ENTREPRISES
        ====================================================== -->
        <section class="bg-white py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid items-center gap-12 lg:grid-cols-2">

                    <div>

                        <span class="text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                            Notre réseau
                        </span>

                        <h2 class="mt-3 text-3xl font-black text-[#26295C] sm:text-4xl">
                            Connecter les compétences aux opportunités.
                        </h2>

                        <p class="mt-5 leading-8 text-slate-600">
                            MOGA encourage la collaboration avec les entreprises,
                            organisations et acteurs professionnels afin de
                            rapprocher la formation des réalités du marché.
                        </p>

                        <div class="mt-8 flex flex-wrap gap-3">
                            <span class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-600">
                                Entreprises
                            </span>

                            <span class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-600">
                                Organisations
                            </span>

                            <span class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-600">
                                Entrepreneurs
                            </span>

                            <span class="rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-600">
                                Professionnels
                            </span>
                        </div>

                    </div>


                    <div class="grid grid-cols-2 gap-4">

                        <div class="flex h-32 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
                            <i class="fa-solid fa-building text-3xl text-[#26295C]/40"></i>
                        </div>

                        <div class="flex h-32 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
                            <i class="fa-solid fa-industry text-3xl text-[#8C4B31]/50"></i>
                        </div>

                        <div class="flex h-32 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
                            <i class="fa-solid fa-handshake text-3xl text-[#8C4B31]/50"></i>
                        </div>

                        <div class="flex h-32 items-center justify-center rounded-2xl border border-slate-200 bg-slate-50">
                            <i class="fa-solid fa-users-gear text-3xl text-[#26295C]/40"></i>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        <!-- =====================================================
             TÉMOIGNAGES
        ====================================================== -->
        <section class="bg-slate-50 py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="text-center">

                    <span class="text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                        Témoignages
                    </span>

                    <h2 class="mt-3 text-3xl font-black text-[#26295C] sm:text-4xl">
                        Des parcours qui prennent forme.
                    </h2>

                </div>


                <div class="mt-12 grid gap-6 md:grid-cols-3">

                    <!-- Témoignage 1 -->
                    <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">

                        <div class="flex gap-1 text-[#8C4B31]">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <p class="mt-5 leading-7 text-slate-600">
                            « La formation m'a permis de mieux comprendre les
                            attentes professionnelles et de transformer mes
                            connaissances en compétences concrètes. »
                        </p>

                        <div class="mt-6 border-t border-slate-100 pt-5">
                            <p class="font-bold text-[#26295C]">
                                Apprenant MOGA
                            </p>
                            <p class="text-sm text-slate-500">
                                Parcours étudiant
                            </p>
                        </div>

                    </article>


                    <!-- Témoignage 2 -->
                    <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">

                        <div class="flex gap-1 text-[#8C4B31]">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <p class="mt-5 leading-7 text-slate-600">
                            « L'approche basée sur les projets m'a donné une
                            meilleure vision de la manière dont les compétences
                            peuvent être utilisées dans une entreprise. »
                        </p>

                        <div class="mt-6 border-t border-slate-100 pt-5">
                            <p class="font-bold text-[#26295C]">
                                Jeune professionnel
                            </p>
                            <p class="text-sm text-slate-500">
                                Parcours professionnel
                            </p>
                        </div>

                    </article>


                    <!-- Témoignage 3 -->
                    <article class="rounded-2xl border border-slate-200 bg-white p-7 shadow-sm">

                        <div class="flex gap-1 text-[#8C4B31]">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>

                        <p class="mt-5 leading-7 text-slate-600">
                            « MOGA met l'accent sur l'humain autant que sur la
                            technique. C'est une approche qui encourage la
                            confiance et l'autonomie. »
                        </p>

                        <div class="mt-6 border-t border-slate-100 pt-5">
                            <p class="font-bold text-[#26295C]">
                                Participant MOGA
                            </p>
                            <p class="text-sm text-slate-500">
                                Parcours de développement
                            </p>
                        </div>

                    </article>

                </div>
            </div>
        </section>


        <!-- =====================================================
             CONTACT
        ====================================================== -->
        <section id="contact" class="bg-white py-20 sm:py-24">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid gap-12 lg:grid-cols-5">

                    <!-- Informations -->
                    <div class="lg:col-span-2">

                        <span class="text-sm font-bold uppercase tracking-widest text-[#8C4B31]">
                            Contact & candidature
                        </span>

                        <h2 class="mt-3 text-3xl font-black text-[#26295C] sm:text-4xl">
                            Construisons votre prochaine étape.
                        </h2>

                        <p class="mt-5 leading-8 text-slate-600">
                            Une question sur nos formations ? Vous souhaitez
                            rejoindre MOGA ou discuter d'une collaboration ?
                            Écrivez-nous.
                        </p>


                        <div class="mt-8 space-y-5">

                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                                    <i class="fa-solid fa-phone"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        Téléphone
                                    </p>
                                    <a
                                        href="tel:+237640119689"
                                        class="mt-1 block font-bold text-[#26295C] hover:text-[#8C4B31]"
                                    >
                                        +237 640 119 689
                                    </a>
                                </div>
                            </div>


                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#8C4B31]/10 text-[#8C4B31]">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        Email
                                    </p>
                                    <a
                                        href="mailto:centre.moga@gmail.com"
                                        class="mt-1 block font-bold text-[#26295C] hover:text-[#8C4B31]"
                                    >
                                        centre.moga@gmail.com
                                    </a>
                                </div>
                            </div>


                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                        LinkedIn
                                    </p>
                                    <a
                                        href="https://www.linkedin.com/company/moga-centre-de-formation/"
                                        class="mt-1 block font-bold text-[#26295C] hover:text-[#8C4B31]"
                                    >
                                        MOGA - Centre de formation
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>


                    <!-- Formulaire -->
                    <div class="lg:col-span-3">

                        <form
                            action="#"
                            method="POST"
                            class="rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm sm:p-8"
                        >

                            <div class="grid gap-5 sm:grid-cols-2">

                                <!-- Nom -->
                                <div class="sm:col-span-2">
                                    <label
                                        for="name"
                                        class="mb-2 block text-sm font-bold text-[#26295C]"
                                    >
                                        Nom complet
                                    </label>

                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        placeholder="Votre nom complet"
                                        required
                                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                    >
                                </div>


                                <!-- Email -->
                                <div>
                                    <label
                                        for="email"
                                        class="mb-2 block text-sm font-bold text-[#26295C]"
                                    >
                                        Email
                                    </label>

                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        placeholder="vous@example.com"
                                        required
                                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                    >
                                </div>


                                <!-- Téléphone -->
                                <div>
                                    <label
                                        for="phone"
                                        class="mb-2 block text-sm font-bold text-[#26295C]"
                                    >
                                        Téléphone
                                    </label>

                                    <input
                                        id="phone"
                                        name="phone"
                                        type="tel"
                                        placeholder="+237 ..."
                                        class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                    >
                                </div>


                                <!-- Message -->
                                <div class="sm:col-span-2">
                                    <label
                                        for="message"
                                        class="mb-2 block text-sm font-bold text-[#26295C]"
                                    >
                                        Message
                                    </label>

                                    <textarea
                                        id="message"
                                        name="message"
                                        rows="6"
                                        placeholder="Écrivez votre message..."
                                        required
                                        class="w-full resize-none rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                    ></textarea>
                                </div>

                            </div>


                            <div class="mt-6 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">

                                <p class="text-xs leading-5 text-slate-500">
                                    Nous vous répondrons dans les meilleurs délais.
                                </p>

                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[#8C4B31] px-6 py-3.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#733d28] sm:w-auto"
                                >
                                    Envoyer le message
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </section>


        <!-- =====================================================
             CTA FINAL
        ====================================================== -->
        <section class="bg-slate-50 py-16">

            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

                <div class="relative overflow-hidden rounded-3xl bg-[#26295C] px-6 py-12 text-center shadow-xl sm:px-12">

                    <div class="absolute -left-20 -top-20 h-48 w-48 rounded-full border-[30px] border-white/5"></div>
                    <div class="absolute -bottom-24 -right-10 h-56 w-56 rounded-full border-[30px] border-[#8C4B31]/20"></div>

                    <div class="relative">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-xl bg-white/10 text-white">
                            <i class="fa-solid fa-hard-hat text-xl"></i>
                        </div>

                        <h2 class="mt-6 text-3xl font-black text-white sm:text-4xl">
                            Prêt à construire votre avenir ?
                        </h2>

                        <p class="mx-auto mt-4 max-w-2xl leading-7 text-white/70">
                            Rejoignez une dynamique de formation orientée
                            compétences, pratique et opportunités.
                        </p>

                        <a
                            href="#contact"
                            class="mt-8 inline-flex items-center gap-2 rounded-lg bg-[#8C4B31] px-7 py-3.5 text-sm font-bold text-white transition hover:bg-[#733d28]"
                        >
                            Rejoindre MOGA
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>
            </div>
        </section>

    </main>


    <!-- =========================================================
         FOOTER
    ========================================================== -->
    <footer class="bg-[#26295C] text-white">

        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">

            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">

                <!-- Brand -->
                <div class="lg:col-span-2">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-white text-[#26295C]">
                            <i class="fa-solid fa-building-columns text-xl"></i>
                        </div>

                        <div>
                            <p class="text-lg font-black">
                                MOGA
                            </p>

                            <p class="text-xs text-white/50">
                                Centre de Formation
                            </p>
                        </div>

                    </div>

                    <p class="mt-5 max-w-md leading-7 text-white/60">
                        Former la jeunesse, développer les compétences et
                        contribuer à construire les opportunités de demain.
                    </p>

                    <div class="mt-6 flex gap-3">

                        <a
                            href="https://www.linkedin.com/company/moga-centre-de-formation/"
                            aria-label="LinkedIn"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-white transition hover:bg-[#8C4B31]"
                        >
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>

                        <a
                            href="mailto:centre.moga@gmail.com"
                            aria-label="Email"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-white transition hover:bg-[#8C4B31]"
                        >
                            <i class="fa-solid fa-envelope"></i>
                        </a>

                        <a
                            href="tel:+237640119689"
                            aria-label="Téléphone"
                            class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-white transition hover:bg-[#8C4B31]"
                        >
                            <i class="fa-solid fa-phone"></i>
                        </a>

                    </div>

                </div>


                <!-- Navigation -->
                <div>

                    <h3 class="text-sm font-bold uppercase tracking-widest text-white">
                        Navigation
                    </h3>

                    <ul class="mt-5 space-y-3 text-sm text-white/60">

                        <li>
                            <a href="#accueil" class="transition hover:text-white">
                                Accueil
                            </a>
                        </li>

                        <li>
                            <a href="#formations" class="transition hover:text-white">
                                Formations
                            </a>
                        </li>

                        <li>
                            <a href="#apropos" class="transition hover:text-white">
                                À propos & Impact
                            </a>
                        </li>

                        <li>
                            <a href="#contact" class="transition hover:text-white">
                                Contact & Candidature
                            </a>
                        </li>

                    </ul>

                </div>


                <!-- Contact -->
                <div>

                    <h3 class="text-sm font-bold uppercase tracking-widest text-white">
                        Contact
                    </h3>

                    <ul class="mt-5 space-y-4 text-sm text-white/60">

                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-phone mt-0.5 text-[#8C4B31]"></i>
                            <a href="tel:+237640119689" class="hover:text-white">
                                +237 640 119 689
                            </a>
                        </li>

                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-envelope mt-0.5 text-[#8C4B31]"></i>
                            <a href="mailto:centre.moga@gmail.com" class="break-all hover:text-white">
                                centre.moga@gmail.com
                            </a>
                        </li>

                        <li class="flex items-start gap-3">
                            <i class="fa-brands fa-linkedin mt-0.5 text-[#8C4B31]"></i>
                            <span>
                                MOGA - Centre de formation
                            </span>
                        </li>

                    </ul>

                </div>

            </div>


            <!-- Copyright -->
            <div class="mt-12 flex flex-col gap-3 border-t border-white/10 pt-7 text-xs text-white/40 sm:flex-row sm:items-center sm:justify-between">

                <p>
                    © 2026 Centre de Formation MOGA Initiative. Tous droits réservés.
                </p>

                <p>
                    Former la jeunesse · Construire le pays
                </p>

            </div>

        </div>
    </footer>


    <!-- =========================================================
         JAVASCRIPT VANILLA
         - Menu mobile
         - Fermeture du menu après clic
         - Scroll fluide
    ========================================================== -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const menuButton = document.getElementById("mobile-menu-button");
            const mobileMenu = document.getElementById("mobile-menu");
            const menuIcon = document.getElementById("menu-icon");

            // Ouverture / fermeture du menu mobile
            menuButton.addEventListener("click", function () {

                const isOpen = !mobileMenu.classList.contains("hidden");

                mobileMenu.classList.toggle("hidden");

                menuButton.setAttribute(
                    "aria-expanded",
                    String(!isOpen)
                );

                if (isOpen) {
                    menuIcon.classList.remove("fa-xmark");
                    menuIcon.classList.add("fa-bars");
                } else {
                    menuIcon.classList.remove("fa-bars");
                    menuIcon.classList.add("fa-xmark");
                }
            });


            // Fermer le menu après avoir cliqué sur un lien
            const mobileLinks = mobileMenu.querySelectorAll("a");

            mobileLinks.forEach(function (link) {

                link.addEventListener("click", function () {

                    mobileMenu.classList.add("hidden");

                    menuIcon.classList.remove("fa-xmark");
                    menuIcon.classList.add("fa-bars");

                    menuButton.setAttribute(
                        "aria-expanded",
                        "false"
                    );
                });

            });


            // Défilement fluide vers les sections
            document.querySelectorAll('a[href^="#"]').forEach(function (link) {

                link.addEventListener("click", function (event) {

                    const targetId = this.getAttribute("href");

                    if (
                        targetId === "#" ||
                        !document.querySelector(targetId)
                    ) {
                        return;
                    }

                    event.preventDefault();

                    document.querySelector(targetId).scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });

                });

            });

        });
    </script>

</body>
</html>