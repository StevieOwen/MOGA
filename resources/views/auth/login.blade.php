<x-authLayout>
    {{-- ==========================================================================
        PAGE DE CONNEXION
        ========================================================================== --}}
    <main class="relative min-h-screen overflow-hidden bg-[#F8FAFC]">

        {{-- ======================================================================
            FILIGRANES / ÉLÉMENTS GRAPHIQUES GÉNIE CIVIL
            Éléments purement décoratifs
            ====================================================================== --}}

        {{-- Grille architecturale en arrière-plan --}}
        <div
            class="pointer-events-none absolute inset-0 opacity-[0.035]"
            aria-hidden="true"
        >
            <div
                class="h-full w-full"
                style="
                    background-image:
                        linear-gradient(#26295C 1px, transparent 1px),
                        linear-gradient(90deg, #26295C 1px, transparent 1px);
                    background-size: 50px 50px;
                "
            ></div>
        </div>

        {{-- Formes géométriques décoratives --}}
        <div
            class="pointer-events-none absolute -left-32 -top-32 h-80 w-80 rounded-full border-[40px] border-[#26295C]/[0.025]"
            aria-hidden="true"
        ></div>

        <div
            class="pointer-events-none absolute -bottom-40 -right-40 h-96 w-96 rounded-full border-[50px] border-[#8C4B31]/[0.035]"
            aria-hidden="true"
        ></div>

        {{-- Ligne structurelle verticale --}}
        <div
            class="pointer-events-none absolute left-8 top-1/4 hidden h-64 w-px bg-[#26295C]/10 lg:block"
            aria-hidden="true"
        >
            <div class="absolute -left-1 top-0 h-2 w-2 rounded-full bg-[#8C4B31]/30"></div>
            <div class="absolute -left-1 bottom-0 h-2 w-2 rounded-full bg-[#26295C]/30"></div>
        </div>

        <div
            class="pointer-events-none absolute right-8 top-1/3 hidden h-64 w-px bg-[#8C4B31]/10 lg:block"
            aria-hidden="true"
        >
            <div class="absolute -left-1 top-0 h-2 w-2 rounded-full bg-[#26295C]/30"></div>
            <div class="absolute -left-1 bottom-0 h-2 w-2 rounded-full bg-[#8C4B31]/30"></div>
        </div>


        {{-- ======================================================================
            CONTENEUR PRINCIPAL
            ====================================================================== --}}
        <div class="relative z-10 flex min-h-screen items-center justify-center px-4 py-10 sm:px-6 lg:px-8">

            <div class="w-full max-w-md">

                {{-- ==================================================================
                    CARTE DE CONNEXION
                    ================================================================== --}}
                <div
                    class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/5"
                >

                    {{-- ==============================================================
                        EN-TÊTE DE LA CARTE
                        ============================================================== --}}
                    <div class="px-6 pb-6 pt-8 text-center sm:px-8 sm:pt-10">

                        {{-- Logo MOGA --}}
                        <a
                            href="{{ url('/') }}"
                            class="inline-flex rounded-lg transition-opacity hover:opacity-90 focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
                            aria-label="Retour à l'accueil MOGA"
                        >
                            <img
                                src="{{ asset('images/logo-moga.jpg') }}"
                                alt="MOGA Initiative Logo"
                                class="mx-auto mb-5 h-16 w-auto object-contain sm:h-20"
                            >
                        </a>

                        {{-- Titre --}}
                        <h1 class="text-2xl font-bold tracking-tight text-[#26295C] sm:text-3xl">
                            Espace Connexion
                        </h1>

                        {{-- Sous-titre --}}
                        <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-500">
                            Accédez à votre espace administrateur pour gérer les formations et les candidatures.
                        </p>

                        {{-- Petite ligne décorative --}}
                        <div class="mx-auto mt-5 flex items-center justify-center gap-2">
                            <span class="h-px w-10 bg-[#26295C]/20"></span>
                            <span class="h-1.5 w-1.5 rotate-45 bg-[#8C4B31]"></span>
                            <span class="h-px w-10 bg-[#26295C]/20"></span>
                        </div>

                    </div>


                    {{-- ==============================================================
                        CORPS DU FORMULAIRE
                        ============================================================== --}}
                    <div class="px-6 pb-8 sm:px-8 sm:pb-10">

                        {{-- Message global d'erreur --}}
                        @if ($errors->any())
                            <div
                                class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4"
                                role="alert"
                            >
                                <div class="flex items-start gap-3">

                                    <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-600">
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                    </div>

                                    <div>
                                        <p class="text-sm font-semibold text-red-800">
                                            Impossible de vous connecter
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-red-600">
                                            Vérifiez vos informations de connexion puis réessayez.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        @endif


                        {{-- ==========================================================
                            FORMULAIRE LARAVEL
                            ========================================================== --}}
                        <form
                            method="POST"
                            action="{{ route('login') }}"
                            class="space-y-5"
                        >

                            @csrf


                            {{-- ======================================================
                                CHAMP EMAIL
                                ====================================================== --}}
                            <div>

                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Adresse email
                                </label>

                                <div class="relative">

                                    {{-- Icône --}}
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                        aria-hidden="true"
                                    >
                                        <i class="fa-solid fa-envelope text-sm"></i>
                                    </div>

                                    {{-- Input --}}
                                    <input
                                        id="email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        required
                                        autofocus
                                        placeholder="exemple@email.com"
                                        class="block w-full rounded-xl border bg-white py-3.5 pl-11 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400
                                            @error('email')
                                                border-red-300 ring-4 ring-red-50
                                            @else
                                                border-slate-200
                                            @enderror
                                            focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                        aria-describedby="email-error"
                                    />

                                </div>

                                {{-- Erreur email --}}
                                @error('email')
                                    <p
                                        id="email-error"
                                        class="mt-2 flex items-center gap-1.5 text-xs font-medium text-red-600"
                                        role="alert"
                                    >
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- ======================================================
                                CHAMP MOT DE PASSE
                                ====================================================== --}}
                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <label
                                        for="password"
                                        class="block text-sm font-semibold text-slate-700"
                                    >
                                        Mot de passe
                                    </label>

                                </div>

                                <div class="relative">

                                    {{-- Icône cadenas --}}
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400"
                                        aria-hidden="true"
                                    >
                                        <i class="fa-solid fa-lock text-sm"></i>
                                    </div>

                                    {{-- Input --}}
                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        autocomplete="current-password"
                                        required
                                        placeholder="Votre mot de passe"
                                        class="block w-full rounded-xl border bg-white py-3.5 pl-11 pr-12 text-sm text-slate-900 outline-none transition placeholder:text-slate-400
                                            @error('password')
                                                border-red-300 ring-4 ring-red-50
                                            @else
                                                border-slate-200
                                            @enderror
                                            focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                        aria-describedby="password-error"
                                    />

                                    {{-- Afficher / masquer le mot de passe --}}
                                    <button
                                        type="button"
                                        id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center px-4 text-slate-400 transition hover:text-[#26295C] focus:outline-none"
                                        aria-label="Afficher le mot de passe"
                                        aria-pressed="false"
                                    >
                                        <i
                                            id="passwordIcon"
                                            class="fa-solid fa-eye text-sm"
                                        ></i>
                                    </button>

                                </div>

                                {{-- Erreur mot de passe --}}
                                @error('password')
                                    <p
                                        id="password-error"
                                        class="mt-2 flex items-center gap-1.5 text-xs font-medium text-red-600"
                                        role="alert"
                                    >
                                        <i class="fa-solid fa-circle-exclamation"></i>
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- ======================================================
                                REMEMBER ME + MOT DE PASSE OUBLIÉ
                                ====================================================== --}}
                            <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center sm:justify-between">

                                {{-- Remember me --}}
                                <label class="inline-flex cursor-pointer items-center gap-2.5">

                                    <input
                                        type="checkbox"
                                        name="remember"
                                        value="1"
                                        {{ old('remember') ? 'checked' : '' }}
                                        class="h-4 w-4 rounded border-slate-300 text-[#26295C] focus:ring-2 focus:ring-[#26295C]/20"
                                    />

                                    <span class="text-sm text-slate-600">
                                        Se souvenir de moi
                                    </span>

                                </label>


                                {{-- Mot de passe oublié --}}
                                @if (Route::has('password.request'))
                                    <a
                                        href="{{ route('password.request') }}"
                                        class="text-sm font-semibold text-[#8C4B31] transition hover:text-[#26295C] hover:underline focus:outline-none focus:ring-2 focus:ring-[#8C4B31]/20"
                                    >
                                        Mot de passe oublié ?
                                    </a>
                                @endif

                            </div>


                            {{-- ======================================================
                                BOUTON DE CONNEXION
                                ====================================================== --}}
                            <button
                                type="submit"
                                class="group flex w-full items-center justify-center gap-2 rounded-xl bg-[#26295C] px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-[#26295C]/10 transition duration-200 hover:bg-[#8C4B31] hover:shadow-[#8C4B31]/20 focus:outline-none focus:ring-4 focus:ring-[#26295C]/20 active:scale-[0.99]"
                            >

                                <span>
                                    Se connecter
                                </span>

                                <i class="fa-solid fa-arrow-right text-xs transition-transform duration-200 group-hover:translate-x-1"></i>

                            </button>

                        </form>

                    </div>


                    {{-- ==============================================================
                        PIED DE LA CARTE
                        ============================================================== --}}
                    <div class="border-t border-slate-100 bg-[#F8FAFC] px-6 py-5 text-center sm:px-8">

                        {{-- Retour accueil --}}
                        <a
                            href="{{ url('/') }}"
                            class="inline-flex items-center gap-2 text-sm font-semibold text-[#26295C] transition hover:text-[#8C4B31]"
                        >
                            <i class="fa-solid fa-arrow-left text-xs"></i>
                            Retour au site principal
                        </a>

                        {{-- Support --}}
                        <p class="mt-3 text-xs text-slate-400">
                            Besoin d'aide ?
                            <a
                                href="mailto:centre.moga@gmail.com"
                                class="font-medium text-slate-500 transition hover:text-[#8C4B31]"
                            >
                                centre.moga@gmail.com
                            </a>
                        </p>

                    </div>

                </div>


                {{-- ==================================================================
                    SIGNATURE / MENTION SOUS LA CARTE
                    ================================================================== --}}
                <div class="mt-6 text-center">

                    <p class="text-xs text-slate-400">
                        © {{ date('Y') }} Centre de Formation MOGA Initiative.
                        Tous droits réservés.
                    </p>

                    <div class="mt-2 flex items-center justify-center gap-2 text-[10px] uppercase tracking-[0.2em] text-slate-300">
                        <span>Former</span>
                        <span class="h-1 w-1 rounded-full bg-[#8C4B31]/50"></span>
                        <span>Construire</span>
                        <span class="h-1 w-1 rounded-full bg-[#8C4B31]/50"></span>
                        <span>Transformer</span>
                    </div>

                </div>

            </div>

        </div>

    </main>


    {{-- ==========================================================================
        FONT AWESOME
        ========================================================================== --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >


    {{-- ==========================================================================
        JAVASCRIPT — AFFICHER / MASQUER LE MOT DE PASSE
        ========================================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput && togglePassword && passwordIcon) {

                togglePassword.addEventListener('click', function () {

                    const isPassword = passwordInput.type === 'password';

                    passwordInput.type = isPassword ? 'text' : 'password';

                    passwordIcon.classList.toggle('fa-eye', !isPassword);
                    passwordIcon.classList.toggle('fa-eye-slash', isPassword);

                    togglePassword.setAttribute(
                        'aria-label',
                        isPassword
                            ? 'Masquer le mot de passe'
                            : 'Afficher le mot de passe'
                    );

                    togglePassword.setAttribute(
                        'aria-pressed',
                        isPassword ? 'true' : 'false'
                    );

                });

            }

        });
    </script>
</x-authLayout>