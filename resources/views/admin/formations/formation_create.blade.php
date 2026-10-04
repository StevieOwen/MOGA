<x-adminLayout>

<div
    x-data="{
        dateDebut: '{{ old('date_debut') }}',
        dateFin: '{{ old('date_fin') }}',
        duree: 0,
        modules: @js(old('modules', [''])),

        calculateDuree() {
            if (!this.dateDebut || !this.dateFin) {
                this.duree = 0;
                return;
            }

            const debut = new Date(this.dateDebut);
            const fin = new Date(this.dateFin);

            if (isNaN(debut.getTime()) || isNaN(fin.getTime()) || fin <= debut) {
                this.duree = 0;
                return;
            }

            const difference = fin.getTime() - debut.getTime();
            this.duree = Math.ceil(difference / (1000 * 60 * 60 * 24));
        },

        addModule() {
            this.modules.push('');
        },

        removeModule(index) {
            if (this.modules.length > 1) {
                this.modules.splice(index, 1);
            }
        }
    }"
    x-init="calculateDuree()"
    class="mx-auto w-full max-w-6xl space-y-6"
>

    {{-- ================================================================
        EN-TÊTE DE LA PAGE
    ================================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-graduation-cap text-lg"></i>
                </div>

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                        Créer une nouvelle formation
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Ajoutez une nouvelle formation au catalogue MOGA Initiative.
                    </p>

                </div>

            </div>

        </div>


        {{-- Retour --}}
        <a
            href="{{ route('formations.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-600 shadow-sm transition hover:border-[#26295C]/20 hover:bg-slate-50 hover:text-[#26295C] focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
        >
            <i class="fa-solid fa-arrow-left"></i>
            Retour à la liste
        </a>

    </div>



    {{-- ================================================================
        MESSAGES D'ERREUR
    ================================================================= --}}
    @if($errors->any())

        <div
            class="rounded-xl border border-red-200 bg-red-50 p-4"
            role="alert"
        >

            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div class="flex-1">

                    <h2 class="text-sm font-bold text-red-800">
                        Impossible d'enregistrer la formation
                    </h2>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li class="flex items-start gap-2">
                                <span class="mt-1.5 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"></span>
                                <span>{{ $error }}</span>
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif



    {{-- ================================================================
        FORMULAIRE PRINCIPAL
    ================================================================= --}}
    <form
        method="POST"
        action="{{ route('formations.store') }}"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf


        {{-- ============================================================
            INFORMATIONS GÉNÉRALES
        ============================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#26295C] text-white">
                        <i class="fa-solid fa-circle-info text-sm"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-[#26295C]">
                            Informations générales
                        </h2>

                        <p class="text-xs text-slate-400">
                            Renseignez les informations principales de la formation.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Contenu --}}
            <div class="grid grid-cols-1 gap-6 p-5 sm:p-6 lg:grid-cols-2">


                {{-- ========================================================
                    INTITULÉ
                ========================================================= --}}
                <div class="lg:col-span-2">

                    <label
                        for="intitule"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Intitulé de la formation
                        <span class="text-[#8C4B31]">*</span>
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>

                        <input
                            id="intitule"
                            type="text"
                            name="intitule"
                            value="{{ old('intitule') }}"
                            required
                            placeholder="Ex. Formation en Génie Civil et Construction"
                            class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('intitule') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >

                    </div>

                    @error('intitule')
                        <p class="mt-1.5 flex items-center gap-1.5 text-xs font-medium text-red-600">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                    @enderror

                </div>



                {{-- ========================================================
                    CATÉGORIE
                ========================================================= --}}
                <div>

                    <label
                        for="categorie"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Catégorie
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-tags"></i>
                        </div>

                        <input
                            id="categorie"
                            type="text"
                            name="categorie"
                            value="{{ old('categorie') }}"
                            placeholder="Ex. Génie Civil"
                            class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('categorie') border-red-400 @enderror"
                        >

                    </div>

                    @error('categorie')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>



                {{-- ========================================================
                    PRIX
                ========================================================= --}}
                <div>

                    <label
                        for="prix"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Prix
                        <span class="text-[#8C4B31]">*</span>
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>

                        <input
                            id="prix"
                            type="number"
                            name="prix"
                            value="{{ old('prix') }}"
                            min="0"
                            step="1"
                            required
                            placeholder="Ex. 150000"
                            class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-20 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('prix') border-red-400 @enderror"
                        >

                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-xs font-bold text-slate-400">
                            FCFA
                        </span>

                    </div>

                    @error('prix')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>



                {{-- ========================================================
                    DISPONIBILITÉ
                ========================================================= --}}
                <div>

                    <label
                        for="disponible"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Disponibilité
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 z-10 flex items-center pl-4 text-slate-400">
                            <i class="fa-solid fa-toggle-on"></i>
                        </div>

                        <select
                            id="disponible"
                            name="disponible"
                            class="w-full appearance-none rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-10 text-sm text-slate-800 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                        >

                            <option
                                value="oui"
                                {{ old('disponible', 'oui') === 'oui' ? 'selected' : '' }}
                            >
                                Oui — Formation disponible
                            </option>

                            <option
                                value="non"
                                {{ old('disponible') === 'non' ? 'selected' : '' }}
                            >
                                Non — Formation indisponible
                            </option>

                        </select>

                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400">
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </div>

                    </div>

                    @error('disponible')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>



                {{-- ========================================================
                    IMAGE
                ========================================================= --}}
                <div>

                    <label
                        for="image"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Image de la formation
                    </label>

                    <div class="relative">

                        <input
                            id="image"
                            type="file"
                            name="image"
                            accept="image/*"
                            class="block w-full cursor-pointer rounded-xl border border-slate-200 bg-white text-sm text-slate-600 file:mr-4 file:cursor-pointer file:border-0 file:bg-[#26295C] file:px-4 file:py-3 file:text-sm file:font-bold file:text-white hover:file:bg-[#8C4B31] focus:outline-none"
                        >

                    </div>

                    <p class="mt-1.5 text-xs text-slate-400">
                        JPG, JPEG, PNG ou WEBP. Utilisez une image claire et représentative.
                    </p>

                    @error('image')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>



        {{-- ================================================================
            DATES & DURÉE
        ================================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- Header --}}
            <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                        <i class="fa-regular fa-calendar-days text-sm"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-[#26295C]">
                            Calendrier de la formation
                        </h2>

                        <p class="text-xs text-slate-400">
                            Définissez la période prévue pour cette formation.
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-6 p-5 sm:p-6 lg:grid-cols-3">


                {{-- Date début --}}
                <div>

                    <label
                        for="date_debut"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Date de début
                    </label>

                    <input
                        id="date_debut"
                        type="datetime-local"
                        name="date_debut"
                        x-model="dateDebut"
                        @change="calculateDuree()"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                    >

                    @error('date_debut')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Date fin --}}
                <div>

                    <label
                        for="date_fin"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Date de fin
                    </label>

                    <input
                        id="date_fin"
                        type="datetime-local"
                        name="date_fin"
                        x-model="dateFin"
                        @change="calculateDuree()"
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                    >

                    @error('date_fin')
                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Durée --}}
                <div>

                    <label
                        for="duree"
                        class="mb-2 block text-sm font-bold text-slate-700"
                    >
                        Durée estimée
                    </label>

                    <div class="relative">

                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-[#8C4B31]">
                            <i class="fa-regular fa-clock"></i>
                        </div>

                        <input
                            id="duree"
                            type="text"
                            :value="duree > 0 ? duree + ' jour' + (duree > 1 ? 's' : '') : '—'"
                            readonly
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm font-bold text-[#26295C] outline-none"
                        >

                    </div>

                    <p class="mt-1.5 text-xs text-slate-400">
                        Calculée automatiquement à partir des dates.
                    </p>

                </div>

            </div>

        </div>



        {{-- ================================================================
            FORMATEURS
        ================================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#26295C] text-white">
                        <i class="fa-solid fa-user-tie text-sm"></i>
                    </div>

                    <div>

                        <h2 class="font-bold text-[#26295C]">
                            Formateurs associés
                        </h2>

                        <p class="text-xs text-slate-400">
                            Sélectionnez les formateurs responsables de cette formation.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                @if($formateurs->count())

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach($formateurs as $formateur)

                            <label
                                class="group flex cursor-pointer items-center gap-3 rounded-xl border border-slate-200 bg-white p-3 transition hover:border-[#26295C]/30 hover:bg-[#26295C]/5"
                            >

                                <input
                                    type="checkbox"
                                    name="formateurs[]"
                                    value="{{ $formateur->id }}"
                                    {{ in_array($formateur->id, old('formateurs', [])) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-slate-300 text-[#26295C] focus:ring-[#26295C]"
                                >

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#26295C]/10 text-sm font-bold text-[#26295C]">
                                    {{ strtoupper(substr($formateur->prenom ?? $formateur->nom ?? 'F', 0, 1)) }}
                                </div>

                                <div class="min-w-0">

                                    <p class="truncate text-sm font-bold text-slate-700">
                                        {{ $formateur->prenom }} {{ $formateur->nom }}
                                    </p>

                                    <p class="text-xs text-slate-400">
                                        Formateur
                                    </p>

                                </div>

                            </label>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-slate-200 text-slate-400">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>

                        <p class="mt-3 text-sm font-semibold text-slate-600">
                            Aucun formateur disponible
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Ajoutez d'abord des formateurs avant de les associer à une formation.
                        </p>

                    </div>

                @endif

                @error('formateurs')
                    <p class="mt-3 text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>



        {{-- ================================================================
            MODULES DYNAMIQUES
        ================================================================= --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                            <i class="fa-solid fa-cubes text-sm"></i>
                        </div>

                        <div>

                            <h2 class="font-bold text-[#26295C]">
                                Modules de la formation
                            </h2>

                            <p class="text-xs text-slate-400">
                                Ajoutez les différents modules pédagogiques.
                            </p>

                        </div>

                    </div>


                    {{-- Ajouter module --}}
                    <button
                        type="button"
                        @click="addModule()"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#8C4B31]/20 bg-[#8C4B31]/5 px-3 py-2 text-xs font-bold text-[#8C4B31] transition hover:bg-[#8C4B31] hover:text-white focus:outline-none focus:ring-4 focus:ring-[#8C4B31]/10"
                    >
                        <i class="fa-solid fa-plus"></i>
                        Ajouter un module
                    </button>

                </div>

            </div>


            <div class="space-y-3 p-5 sm:p-6">

                <template x-for="(module, index) in modules" :key="index">

                    <div class="flex items-center gap-3">

                        {{-- Numéro --}}
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#26295C]/10 text-xs font-bold text-[#26295C]"
                            x-text="index + 1"
                        ></div>


                        {{-- Champ module --}}
                        <div class="relative flex-1">

                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                <i class="fa-solid fa-cube"></i>
                            </div>

                            <input
                                type="text"
                                name="modules[]"
                                x-model="modules[index]"
                                placeholder="Nom du module"
                                class="w-full rounded-xl border border-slate-200 bg-white py-3 pl-11 pr-4 text-sm text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                            >

                        </div>


                        {{-- Supprimer --}}
                        <button
                            type="button"
                            @click="removeModule(index)"
                            x-show="modules.length > 1"
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-100"
                            title="Supprimer ce module"
                        >
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>

                    </div>

                </template>


                {{-- Message informatif --}}
                <div class="mt-4 flex items-start gap-3 rounded-xl bg-[#F8FAFC] p-4">

                    <i class="fa-solid fa-circle-info mt-0.5 text-[#8C4B31]"></i>

                    <p class="text-xs leading-5 text-slate-500">
                        Vous pouvez ajouter autant de modules que nécessaire.
                        Les modules vides seront traités selon les règles de validation du serveur.
                    </p>

                </div>

                @error('modules')
                    <p class="text-xs font-medium text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>



        {{-- ================================================================
            ACTIONS DU FORMULAIRE
        ================================================================= --}}
        <div class="sticky bottom-0 z-20 -mx-4 border-t border-slate-200 bg-[#F8FAFC]/95 px-4 py-4 backdrop-blur sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

            <div class="mx-auto flex max-w-6xl flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-end">

                {{-- Annuler --}}
                <a
                    href="{{ route('formations.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-100"
                >
                    <i class="fa-solid fa-xmark"></i>
                    Annuler
                </a>


                {{-- Enregistrer --}}
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#26295C] px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31] focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Enregistrer la formation
                </button>

            </div>

        </div>

    </form>

</div>


{{-- ================================================================
    ALPINE CLOAK
================================================================= --}}
<style>
    [x-cloak] {
        display: none !important;
    }
</style>

</x-adminLayout>