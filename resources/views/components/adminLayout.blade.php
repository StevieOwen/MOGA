<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- ======================================================================
        META
        ====================================================================== --}}
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'Administration MOGA')
    </title>

    {{-- ======================================================================
        TAILWIND CSS
        ----------------------------------------------------------------------
        Tailwind doit être compilé par Vite dans le projet Laravel.
        ====================================================================== --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ======================================================================
        FONT AWESOME
        ====================================================================== --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    {{-- ======================================================================
        ALPINE.JS
        ----------------------------------------------------------------------
        Utilisé pour le drawer mobile et le menu profil.
        ====================================================================== --}}
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

</head>


<body
    class="min-h-screen bg-[#F8FAFC] font-sans text-slate-800 antialiased"
    x-data="{
        sidebarOpen: false,
        profileOpen: false
    }"
    @keydown.escape="sidebarOpen = false; profileOpen = false"
>


{{-- ==========================================================================
    APPLICATION WRAPPER
    ========================================================================== --}}
<div class="min-h-screen">


    {{-- ======================================================================
        TOPBAR
        ====================================================================== --}}
    <header
        class="fixed inset-x-0 top-0 z-50 h-16 border-b border-slate-200 bg-white/95 shadow-sm backdrop-blur"
    >

        <div class="flex h-full items-center justify-between px-4 sm:px-6 lg:px-8">


            {{-- ==============================================================
                PARTIE GAUCHE DU TOPBAR
                ============================================================== --}}
            <div class="flex min-w-0 items-center gap-3">


                {{-- ----------------------------------------------------------
                    BOUTON BURGER MOBILE
                    ---------------------------------------------------------- --}}
                <button
                    type="button"
                    @click="sidebarOpen = true"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-600 transition hover:bg-slate-100 hover:text-[#26295C] focus:outline-none focus:ring-4 focus:ring-[#26295C]/10 lg:hidden"
                    aria-label="Ouvrir le menu"
                >
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>


                {{-- ----------------------------------------------------------
                    LOGO
                    ---------------------------------------------------------- --}}
                <a
                    href="#"
                    class="flex shrink-0 items-center"
                    aria-label="Administration MOGA"
                >

                    <img
                        src="{{ asset('images/logo-moga.jpg') }}"
                        alt="MOGA Initiative Logo"
                        class="h-10 w-auto object-contain"
                    >

                </a>


                {{-- ----------------------------------------------------------
                    SÉPARATEUR
                    ---------------------------------------------------------- --}}
                <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>


                {{-- ----------------------------------------------------------
                    TITRE ADMINISTRATION
                    ---------------------------------------------------------- --}}
                <div class="hidden min-w-0 sm:block">

                    <p class="truncate text-sm font-bold text-[#26295C]">
                        Administration MOGA
                    </p>

                    <p class="hidden text-xs text-slate-400 md:block">
                        Panneau de contrôle
                    </p>

                </div>

            </div>


            {{-- ==============================================================
                PARTIE DROITE DU TOPBAR
                ============================================================== --}}
            <div class="flex items-center gap-2 sm:gap-4">


                {{-- ----------------------------------------------------------
                    INDICATEUR ADMIN
                    ---------------------------------------------------------- --}}
                <div class="hidden items-center gap-2 md:flex">

                    <span class="relative flex h-2.5 w-2.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
                    </span>

                    <span class="text-xs font-medium text-slate-500">
                        Administration
                    </span>

                </div>


                {{-- ----------------------------------------------------------
                    MENU PROFIL
                    ---------------------------------------------------------- --}}
                <div class="relative">

                    {{-- Bouton profil --}}
                    <button
                        type="button"
                        @click="profileOpen = !profileOpen"
                        @click.outside="profileOpen = false"
                        class="flex items-center gap-2 rounded-xl p-1.5 transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
                        :aria-expanded="profileOpen"
                    >

                        {{-- Avatar --}}
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#26295C] text-sm font-bold text-white shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>


                        {{-- Informations utilisateur --}}
                        <div class="hidden text-left lg:block">

                            <p class="max-w-[150px] truncate text-sm font-semibold text-slate-700">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="max-w-[150px] truncate text-xs text-slate-400">
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        {{-- Chevron --}}
                        <i
                            class="fa-solid fa-chevron-down hidden text-xs text-slate-400 transition-transform lg:block"
                            :class="{ 'rotate-180': profileOpen }"
                        ></i>

                    </button>


                    {{-- ------------------------------------------------------
                        DROPDOWN PROFIL
                        ------------------------------------------------------ --}}
                    <div
                        x-cloak
                        x-show="profileOpen"
                        x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-14 w-72 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10"
                    >

                        {{-- En-tête profil --}}
                        <div class="border-b border-slate-100 bg-[#F8FAFC] px-4 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#26295C] text-base font-bold text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-bold text-slate-800">
                                        {{ Auth::user()->name }}
                                    </p>

                                    <p class="truncate text-xs text-slate-500">
                                        {{ Auth::user()->email }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Liens du profil --}}
                        <div class="p-2">

                            @if (Route::has('admin.profile'))

                                <a
                                    href="{{ route('admin.profile') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-[#26295C]"
                                >
                                    <i class="fa-regular fa-user w-5 text-center text-slate-400"></i>
                                    Mon profil
                                </a>

                            @endif


                            @if (Route::has('admin.settings'))

                                <a
                                    href="{{ route('admin.settings') }}"
                                    class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-[#26295C]"
                                >
                                    <i class="fa-solid fa-gear w-5 text-center text-slate-400"></i>
                                    Paramètres
                                </a>

                            @endif

                        </div>


                        {{-- Déconnexion --}}
                        <div class="border-t border-slate-100 p-2">

                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold text-[#8C4B31] transition hover:bg-[#8C4B31]/5"
                                >

                                    <i class="fa-solid fa-sign-out-alt w-5 text-center"></i>

                                    Se déconnecter

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </header>



    {{-- ==========================================================================
        OVERLAY MOBILE
        ========================================================================== --}}
    <div
        x-cloak
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden"
        aria-hidden="true"
    ></div>



    {{-- ==========================================================================
        SIDEBAR
        ========================================================================== --}}
    <aside
    class="fixed bottom-0 left-0 top-0 z-40 flex w-72 flex-col bg-[#26295C] shadow-2xl transition-transform duration-300 lg:top-16 lg:z-30 lg:w-64"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    >

        {{-- ==================================================================
            EN-TÊTE SIDEBAR
            ================================================================== --}}
        <div class="flex h-16 shrink-0 items-center justify-between border-b border-white/10 px-5">

            <a
                href="#"
                class="flex items-center gap-3"
            >

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-white p-1">
                    <img
                        src="{{ asset('images/logo-moga.jpg') }}"
                        alt="MOGA"
                        class="h-full w-full object-contain"
                    >
                </div>

                <div>
                    <p class="text-sm font-bold text-white">
                        MOGA Initiative
                    </p>

                    <p class="text-[10px] uppercase tracking-wider text-white/50">
                        Administration
                    </p>
                </div>

            </a>


            {{-- Fermeture mobile --}}
            <button
                type="button"
                @click="sidebarOpen = false"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-white/70 transition hover:bg-white/10 hover:text-white lg:hidden"
                aria-label="Fermer le menu"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>



        {{-- ==================================================================
            TITRE DU PANNEAU
            ================================================================== --}}
        <div class="px-5 pb-2 pt-6">

            <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-white/40">
                Panneau de contrôle
            </p>

        </div>



        {{-- ==================================================================
            NAVIGATION
            ================================================================== --}}
        <nav class="flex-1 overflow-y-auto px-3 pb-6">

            <div class="space-y-1">


                {{-- ==========================================================
                    VUE D'ENSEMBLE
                    ========================================================== --}}
                <a
                    href="{{route('overview')}}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('overview') || request()->routeIs('overview')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-chart-line"></i>
                    </span>

                    <span class="flex-1">
                        Vue d'ensemble
                    </span>

                </a>



                {{-- ==========================================================
                    FORMATIONS
                    ========================================================== --}}
                <a
                    href="{{ route('formations.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('formations.*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('admin.formations.*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-graduation-cap"></i>
                    </span>

                    <span class="flex-1">
                        Formations
                    </span>

                </a>



                {{-- ==========================================================
                    MODULES
                    ========================================================== --}}
                <!-- <a
                    href="{{ route('modules.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('modules.*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('modules.*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-cubes"></i>
                    </span>

                    <span class="flex-1">
                        Modules
                    </span>

                </a> -->



                {{-- ==========================================================
                    FORMATEURS
                    ========================================================== --}}
                <a
                    href="{{ route('formateurs.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('formateurs.*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('formateurs.*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-user-tie"></i>
                    </span>

                    <span class="flex-1">
                        Formateurs
                    </span>

                </a>



                {{-- ==========================================================
                    ANNONCES
                    ========================================================== --}}
                <a
                    href="{{ route('annonces.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('annonces.*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('annonces.*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-bullhorn"></i>
                    </span>

                    <span class="flex-1">
                        Annonces
                    </span>

                </a>



                {{-- ==========================================================
                    INSCRIPTIONS & ÉLÈVES
                    ========================================================== --}}
                <a
                    href="{{ route('inscriptions.index') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('inscriptions.*') || request()->routeIs('admin.eleves.*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('inscriptions.*') || request()->routeIs('admin.eleves.*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-users"></i>
                    </span>

                    <span class="flex-1">
                        Inscriptions & Élèves
                    </span>

                </a>



                {{-- ==========================================================
                    SÉPARATEUR
                    ========================================================== --}}
                <div class="my-4 border-t border-white/10"></div>



                {{-- ==========================================================
                    PARAMÈTRES
                    ========================================================== --}}
                <a
                    href="{{ route('settings') }}"
                    class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition
                    {{ request()->routeIs('settings*')
                        ? 'bg-white text-[#26295C] shadow-sm'
                        : 'text-white/70 hover:bg-white/10 hover:text-white'
                    }}"
                >

                    <span
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition
                        {{ request()->routeIs('settings*')
                            ? 'bg-[#26295C] text-white'
                            : 'bg-white/5 text-white/60 group-hover:bg-white/10 group-hover:text-white'
                        }}"
                    >
                        <i class="fa-solid fa-cog"></i>
                    </span>

                    <span class="flex-1">
                        Paramètres
                    </span>

                </a>

            </div>

        </nav>



        {{-- ==================================================================
            FOOTER SIDEBAR
            ================================================================== --}}
        <div class="shrink-0 border-t border-white/10 p-4">

            <div class="rounded-xl bg-white/5 p-3">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                        <i class="fa-solid fa-building-columns text-sm"></i>
                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-xs font-semibold text-white">
                            MOGA Initiative
                        </p>

                        <p class="truncate text-[10px] text-white/40">
                            Former & Construire
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </aside>



    {{-- ==========================================================================
        CONTENU PRINCIPAL
        ========================================================================== --}}
    <main
        class="min-h-screen pt-16 lg:pl-64"
    >

        <div class="mx-auto w-full max-w-[1600px] p-4 sm:p-6 lg:p-8">


            {{-- ==================================================================
                BREADCRUMB
                ================================================================== --}}
            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">

                <nav
                    class="flex items-center gap-2 text-sm"
                    aria-label="Fil d'Ariane"
                >

                    <a
                        href="#"
                        class="font-medium text-slate-400 transition hover:text-[#26295C]"
                    >
                        Administration
                    </a>

                    <!-- <i class="fa-solid fa-chevron-right text-[9px] text-slate-300"></i>

                    <span class="font-semibold text-[#26295C]">
                        @yield('breadcrumb', 'Vue d’ensemble')
                    </span> -->

                </nav>


                {{-- Date --}}
                <div class="hidden items-center gap-2 text-xs text-slate-400 sm:flex">

                    <i class="fa-regular fa-calendar"></i>

                    <span>
                        {{ now()->translatedFormat('l d F Y') }}
                    </span>

                </div>

            </div>

                {{ $slot }}

            



                    {{-- ----------------------------------------------------------
                        FOOTER DASHBOARD
                        ---------------------------------------------------------- --}}
                    <div class="flex flex-col gap-2 border-t border-slate-200 pt-5 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between">

                        <p>
                            © {{ date('Y') }} Centre de Formation MOGA Initiative.
                        </p>

                        <p>
                            Former la jeunesse, Construire le pays.
                        </p>

                    </div>

                </div>

            

        </div>

    </main>

</div>



{{-- ==========================================================================
    ALPINE CLOAK
    --------------------------------------------------------------------------
    x-cloak empêche les dropdowns de s'afficher avant le chargement d'Alpine.
    ========================================================================== --}}
<style>
    [x-cloak] {
        display: none !important;
    }
</style>


</body>
</html>