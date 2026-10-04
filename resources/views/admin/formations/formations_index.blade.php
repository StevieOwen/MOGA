<x-adminLayout>

<div
    x-data="{
        deleteModalOpen: false,
        deleteUrl: '',
        formationName: '',

        openDeleteModal(url, name) {
            this.deleteUrl = url;
            this.formationName = name;
            this.deleteModalOpen = true;
        },

        closeDeleteModal() {
            this.deleteModalOpen = false;
            this.deleteUrl = '';
            this.formationName = '';
        }
    }"
    @keydown.escape.window="closeDeleteModal()"
    class="space-y-6"
>

    {{-- ================================================================
        EN-TÊTE DE LA PAGE
    ================================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-2">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-graduation-cap"></i>
                </span>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                        Formations
                    </h1>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Gérez les formations, programmes et contenus pédagogiques de MOGA.
                    </p>
                </div>
            </div>
        </div>

        {{-- Bouton ajouter --}}
        <a
            href="{{ route('formations.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#26295C] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31] focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
        >
            <i class="fa-solid fa-plus"></i>
            <span>Ajouter une Formation</span>
        </a>

    </div>


    {{-- ================================================================
        MESSAGES FLASH
    ================================================================= --}}

    @if(session('success'))
        <div
            class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800"
            role="alert"
        >
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                <i class="fa-solid fa-check"></i>
            </div>

            <div class="flex-1">
                <p class="text-sm font-bold">
                    Opération réussie
                </p>

                <p class="mt-0.5 text-sm">
                    {{ session('success') }}
                </p>
            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="text-emerald-500 transition hover:text-emerald-700"
                aria-label="Fermer"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif


    @if(session('error'))
        <div
            class="flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800"
            role="alert"
        >
            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                <i class="fa-solid fa-circle-exclamation"></i>
            </div>

            <div class="flex-1">
                <p class="text-sm font-bold">
                    Une erreur est survenue
                </p>

                <p class="mt-0.5 text-sm">
                    {{ session('error') }}
                </p>
            </div>

            <button
                type="button"
                onclick="this.parentElement.remove()"
                class="text-red-500 transition hover:text-red-700"
                aria-label="Fermer"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif


    {{-- ================================================================
        BARRE D'INFORMATIONS
    ================================================================= --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

        {{-- Total --}}
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Total formations
                    </p>

                    <p class="text-xl font-bold text-slate-800">
                        {{ $formations->count() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Disponibles --}}
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Disponibles
                    </p>

                    <p class="text-xl font-bold text-slate-800">
                        {{ $formations->where('disponible', 'oui')->count() }}
                    </p>
                </div>

            </div>
        </div>


        {{-- Indisponibles --}}
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-red-50 text-red-600">
                    <i class="fa-solid fa-circle-xmark"></i>
                </div>

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                        Indisponibles
                    </p>

                    <p class="text-xl font-bold text-slate-800">
                        {{ $formations->where('disponible', 'non')->count() }}
                    </p>
                </div>

            </div>
        </div>

    </div>


    {{-- ================================================================
        TABLEAU DES FORMATIONS
    ================================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- En-tête tableau --}}
        <div class="flex flex-col gap-3 border-b border-slate-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="text-base font-bold text-[#26295C]">
                    Liste des formations
                </h2>

                <p class="mt-0.5 text-xs text-slate-400">
                    Consultez et gérez les formations enregistrées.
                </p>
            </div>

            <div class="inline-flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-500">
                <i class="fa-solid fa-database text-[#8C4B31]"></i>
                {{ $formations->count() }} formation(s)
            </div>

        </div>


        {{-- ============================================================
            VERSION RESPONSIVE
        ============================================================= --}}
        <div class="overflow-x-auto">

            <table class="min-w-[1200px] w-full text-left">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Formation
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Prix & Durée
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Statut
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Dates
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Formateurs
                        </th>

                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Modules
                        </th>

                        <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($formations as $formation)

                        <tr class="group transition hover:bg-slate-50/70">

                            {{-- =================================================
                                IMAGE + INTITULÉ + CATÉGORIE
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex min-w-[280px] items-center gap-4">

                                    {{-- Image --}}
                                    <div class="h-16 w-20 shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-100">

                                        @if($formation->image)

                                            <img
                                                src="{{ asset('storage/' . $formation->image) }}"
                                                alt="{{ $formation->intitule }}"
                                                class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center bg-[#26295C]/5 text-[#26295C]">
                                                <i class="fa-solid fa-graduation-cap text-xl"></i>
                                            </div>

                                        @endif

                                    </div>


                                    {{-- Informations --}}
                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-bold text-slate-800">
                                            {{ $formation->intitule }}
                                        </p>

                                        @if($formation->categorie)

                                            <span class="mt-1 inline-flex items-center rounded-full bg-[#26295C]/10 px-2.5 py-1 text-[11px] font-semibold text-[#26295C]">
                                                {{ $formation->categorie }}
                                            </span>

                                        @else

                                            <span class="mt-1 inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-medium text-slate-500">
                                                Non catégorisée
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                PRIX + DURÉE
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="space-y-1">

                                    <p class="whitespace-nowrap text-sm font-bold text-slate-800">

                                        @if(is_numeric($formation->prix))

                                            {{ number_format($formation->prix, 0, ',', ' ') }} FCFA

                                        @else

                                            {{ $formation->prix ?? '—' }}

                                        @endif

                                    </p>

                                    <p class="flex items-center gap-1.5 text-xs text-slate-500">
                                        <i class="fa-regular fa-clock text-[#8C4B31]"></i>

                                        {{ $formation->duree ?? '—' }}

                                        @if($formation->duree && is_numeric($formation->duree))
                                            heures
                                        @endif
                                    </p>

                                </div>

                            </td>


                            {{-- =================================================
                                STATUT
                            ================================================== --}}
                            <td class="px-5 py-4">

                                @if($formation->disponible === 'oui')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                        Disponible

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                        Indisponible

                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                DATES
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="space-y-1 text-xs">

                                    <div class="flex items-center gap-2 text-slate-600">

                                        <i class="fa-regular fa-calendar-plus w-4 text-[#26295C]"></i>

                                        <span>
                                            {{ $formation->date_debut ? \Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y') : '—' }}
                                        </span>

                                    </div>

                                    <div class="flex items-center gap-2 text-slate-500">

                                        <i class="fa-regular fa-calendar-check w-4 text-[#8C4B31]"></i>

                                        <span>
                                            {{ $formation->date_fin ? \Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y') : '—' }}
                                        </span>

                                    </div>

                                </div>

                            </td>


                            {{-- =================================================
                                FORMATEURS
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex max-w-[220px] flex-wrap gap-1.5">

                                    @forelse($formation->formateurs as $formateur)

                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-white px-2.5 py-1 text-[11px] font-semibold text-slate-600">

                                            <span class="flex h-5 w-5 items-center justify-center rounded-full bg-[#26295C]/10 text-[9px] text-[#26295C]">
                                                {{ strtoupper(substr($formateur->prenom ?? $formateur->nom ?? 'F', 0, 1)) }}
                                            </span>

                                            {{ $formateur->prenom }} {{ $formateur->nom }}

                                        </span>

                                    @empty

                                        <span class="text-xs italic text-slate-400">
                                            Aucun formateur
                                        </span>

                                    @endforelse

                                </div>

                            </td>


                            {{-- =================================================
                                MODULES
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex max-w-[220px] flex-wrap gap-1.5">

                                    @forelse($formation->modules as $module)

                                        <span class="inline-flex items-center rounded-full bg-[#8C4B31]/10 px-2.5 py-1 text-[11px] font-semibold text-[#8C4B31]">

                                            <i class="fa-solid fa-cube mr-1.5 text-[9px]"></i>

                                            {{ $module->nom ?? $module->intitule ?? 'Module' }}

                                        </span>

                                    @empty

                                        <span class="text-xs italic text-slate-400">
                                            Aucun module
                                        </span>

                                    @endforelse

                                </div>

                                @if($formation->modules->count() > 0)

                                    <p class="mt-1.5 text-[11px] text-slate-400">
                                        {{ $formation->modules->count() }}
                                        module{{ $formation->modules->count() > 1 ? 's' : '' }}
                                    </p>

                                @endif

                            </td>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Modifier --}}
                                    <a
                                        href="{{ route('formations.edit', $formation->id) }}"
                                        title="Modifier"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-[#26295C]/20 hover:bg-[#26295C] hover:text-white focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
                                    >
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>


                                    {{-- Supprimer --}}
                                    <button
                                        type="button"
                                        title="Supprimer"
                                        @click="openDeleteModal(
                                            '{{ route('formations.destroy', $formation->id) }}',
                                            @js($formation->intitule)
                                        )"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-white text-red-500 transition hover:border-red-500 hover:bg-red-500 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-100"
                                    >
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- =====================================================
                            AUCUNE FORMATION
                        ====================================================== --}}
                        <tr>

                            <td
                                colspan="7"
                                class="px-5 py-16 text-center"
                            >

                                <div class="mx-auto flex max-w-md flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-[#26295C]/10 text-[#26295C]">
                                        <i class="fa-solid fa-graduation-cap text-2xl"></i>
                                    </div>

                                    <h3 class="mt-4 text-base font-bold text-slate-800">
                                        Aucune formation trouvée
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Commencez par créer votre première formation MOGA.
                                    </p>

                                    <a
                                        href="{{ route('formations.create') }}"
                                        class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#26295C] px-4 py-2.5 text-sm font-bold text-white transition hover:bg-[#8C4B31]"
                                    >
                                        <i class="fa-solid fa-plus"></i>
                                        Ajouter une Formation
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- ================================================================
            PAGINATION
        ================================================================= --}}
        @if(method_exists($formations, 'links'))

            <div class="border-t border-slate-200 px-5 py-4">
                {{ $formations->links() }}
            </div>

        @endif

    </div>



    {{-- ================================================================
        MODAL DE CONFIRMATION DE SUPPRESSION
    ================================================================= --}}
    <div
        x-cloak
        x-show="deleteModalOpen"
        x-transition.opacity
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        aria-labelledby="delete-modal-title"
        role="dialog"
        aria-modal="true"
    >

        {{-- Overlay --}}
        <div
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"
            @click="closeDeleteModal()"
        ></div>


        {{-- Contenu modal --}}
        <div
            x-show="deleteModalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="translate-y-4 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-4 scale-95 opacity-0"
            class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
        >

            {{-- Bandeau supérieur --}}
            <div class="h-1.5 bg-[#8C4B31]"></div>


            <div class="p-6">

                {{-- Icône --}}
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-red-600">

                    <i class="fa-solid fa-trash-can text-xl"></i>

                </div>


                {{-- Texte --}}
                <div class="mt-5">

                    <h2
                        id="delete-modal-title"
                        class="text-lg font-bold text-[#26295C]"
                    >
                        Supprimer cette formation ?
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-500">

                        Vous êtes sur le point de supprimer la formation

                        <strong
                            class="font-bold text-slate-700"
                            x-text="formationName"
                        ></strong>.

                        Cette action est irréversible.

                    </p>

                </div>


                {{-- Boutons --}}
                <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    {{-- Annuler --}}
                    <button
                        type="button"
                        @click="closeDeleteModal()"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 focus:outline-none focus:ring-4 focus:ring-slate-100"
                    >
                        <i class="fa-solid fa-xmark"></i>
                        Annuler
                    </button>


                    {{-- Formulaire DELETE --}}
                    <form
                        method="POST"
                        :action="deleteUrl"
                        class="inline-flex"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#8C4B31] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-100 sm:w-auto"
                        >
                            <i class="fa-solid fa-trash-can"></i>
                            Confirmer la suppression
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

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