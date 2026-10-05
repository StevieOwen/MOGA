<x-adminLayout>

<div 
    x-data="{ activeTab: 'profil' }"
    class="mx-auto w-full max-w-5xl space-y-6"
>
    {{-- EN-TÊTE --}}
    <div class="flex items-center gap-3">
        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
            <i class="fa-solid fa-gear text-lg"></i>
        </div>
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                Paramètres du système
            </h1>
            <p class="mt-0.5 text-sm text-slate-500">
                Gérez votre compte administrateur et les configurations de la plateforme.
            </p>
        </div>
    </div>

    {{-- MESSAGES FLASH --}}
    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4" role="alert">
            <div class="flex items-start gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-emerald-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- NAV ONGLETS --}}
    <div class="flex border-b border-slate-200 gap-6">
        <button 
            @click="activeTab = 'profil'"
            :class="activeTab === 'profil' ? 'border-[#26295C] text-[#26295C] font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'"
            class="pb-3 text-sm border-b-2 transition"
        >
            <i class="fa-solid fa-user-shield mr-2"></i>Mon Profil Admin
        </button>
        <button 
            @click="activeTab = 'site'"
            :class="activeTab === 'site' ? 'border-[#26295C] text-[#26295C] font-bold' : 'border-transparent text-slate-500 hover:text-slate-700'"
            class="pb-3 text-sm border-b-2 transition"
        >
            <i class="fa-solid fa-sliders mr-2"></i>Informations de la plateforme
        </button>
    </div>

    {{-- CONTENU 1 : PROFIL ADMIN --}}
    <div x-show="activeTab === 'profil'" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
            <h2 class="font-bold text-[#26295C]">Modifier mes identifiants</h2>
        </div>

        <form action="{{ route('settings.updateProfile') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                {{-- NOM --}}
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Nom complet
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $admin->name ?? '') }}" 
                        required
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Adresse Email
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email', $admin->email ?? '') }}" 
                        required
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <hr class="border-slate-100">

            <h3 class="text-sm font-bold text-[#26295C]">Changer de mot de passe (optionnel)</h3>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                {{-- MOT DE PASSE ACTUEL --}}
                <div class="space-y-1.5">
                    <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Mot de passe actuel
                    </label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('current_password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NOUVEAU MOT DE PASSE --}}
                <div class="space-y-1.5">
                    <label for="new_password" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Nouveau mot de passe
                    </label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('new_password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CONFIRMATION --}}
                <div class="space-y-1.5">
                    <label for="new_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Confirmer le mot de passe
                    </label>
                    <input 
                        type="password" 
                        id="new_password_confirmation" 
                        name="new_password_confirmation" 
                        class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                </div>
            </div>

            <div class="flex items-center justify-end border-t border-slate-100 pt-5">
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 rounded-xl bg-[#26295C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31]"
                >
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

    {{-- CONTENU 2 : INFOS DU SITE --}}
    <div x-cloak x-show="activeTab === 'site'" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
            <h2 class="font-bold text-[#26295C]">Informations Générales</h2>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Nom de l'application</label>
                    <input type="text" value="{{ config('app.name', 'MOGA') }}" disabled class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-500 cursor-not-allowed">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Environnement</label>
                    <input type="text" value="{{ config('app.env') }}" disabled class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-500 cursor-not-allowed">
                </div>
            </div>

            <p class="text-xs text-slate-400 italic">
                * Les configurations globales de l'application peuvent également être ajustées via le fichier de configuration `.env`.
            </p>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>

</x-adminLayout>