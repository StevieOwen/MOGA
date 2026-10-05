<x-adminLayout>


<div
    x-data="{
        deleteModalOpen: false,
        deleteUrl: '',
        formateurName: '',

        // State pour le modal d'édition
        editModalOpen: false,
        editUrl: '',
        editFormateur: {
            id: '',
            nom: '',
            prenom: '',
            email: '',
            qualification: ''
        },

        openDeleteModal(url, name) {
            this.deleteUrl = url;
            this.formateurName = name;
            this.deleteModalOpen = true;
        },

        closeDeleteModal() {
            this.deleteModalOpen = false;
            this.deleteUrl = '';
            this.formateurName = '';
        },

        openEditModal(url, formateur) {
            this.editUrl = url;
            this.editFormateur = {
                id: formateur.id,
                nom: formateur.nom || '',
                prenom: formateur.prenom || '',
                email: formateur.email || '',
                qualification: formateur.qualification || ''
            };
            this.editModalOpen = true;
        },

        closeEditModal() {
            this.editModalOpen = false;
            this.editUrl = '';
        }
    }"
    @keydown.escape.window="closeDeleteModal(); closeEditModal();"
    class="mx-auto w-full max-w-7xl space-y-6"
>

    {{-- ================================================================
        EN-TÊTE DE LA PAGE
    ================================================================= --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-user-tie text-lg"></i>
                </div>

                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                        Gestion des Formateurs
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Gérez les formateurs et leurs formations attribuées.
                    </p>
                </div>

            </div>
        </div>

        {{-- Bouton Ajouter --}}
        <a
            href="{{ route('formateurs.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#26295C] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31] focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
        >
            <i class="fa-solid fa-user-plus"></i>
            Ajouter un Formateur
        </a>

    </div>



    {{-- ================================================================
        ALERTES FLASH
    ================================================================= --}}

    @if(session('success'))

        <div
            class="rounded-xl border border-emerald-200 bg-emerald-50 p-4"
            role="alert"
        >
            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <div class="flex-1">
                    <p class="text-sm font-semibold text-emerald-800">
                        {{ session('success') }}
                    </p>
                </div>

            </div>
        </div>

    @endif


    @if(session('error'))

        <div
            class="rounded-xl border border-red-200 bg-red-50 p-4"
            role="alert"
        >
            <div class="flex items-start gap-3">

                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>

                <div class="flex-1">
                    <p class="text-sm font-semibold text-red-800">
                        {{ session('error') }}
                    </p>
                </div>

            </div>
        </div>

    @endif



    {{-- ================================================================
        CARTE PRINCIPALE / TABLEAU
    ================================================================= --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- En-tête du tableau --}}
        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="font-bold text-[#26295C]">
                        Liste des formateurs
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">
                        {{ $formateurs->count() }}
                        {{ $formateurs->count() > 1 ? 'formateurs enregistrés' : 'formateur enregistré' }}
                    </p>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-users"></i>
                </div>

            </div>

        </div>



        {{-- ============================================================
            TABLE RESPONSIVE
        ============================================================= --}}
        <div class="overflow-x-auto">

            <table class="min-w-[1100px] w-full text-left">

                <thead class="border-b border-slate-200 bg-white">

                    <tr>

                        <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Formateur
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Email
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Qualification
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                            Formations attribuées
                        </th>

                        <th class="whitespace-nowrap px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($formateurs as $formateur)

                        @php
                            $prenom = $formateur->prenom ?? '';
                            $nom = $formateur->nom ?? '';

                            $initiales = strtoupper(
                                substr($prenom, 0, 1) .
                                substr($nom, 0, 1)
                            );

                            $nomComplet = trim($prenom . ' ' . $nom);
                        @endphp

                        <tr class="group transition hover:bg-slate-50/70">

                            {{-- =================================================
                                FORMATEUR / AVATAR
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Avatar --}}
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#26295C] text-sm font-bold text-white shadow-sm">
                                        {{ $initiales ?: 'F' }}
                                    </div>

                                    {{-- Nom --}}
                                    <div class="min-w-0">

                                        <p class="text-sm font-bold text-slate-800">
                                            {{ strtoupper($nom) }}
                                        </p>

                                        <p class="mt-0.5 text-sm text-slate-500">
                                            {{ $prenom ? ucfirst($prenom) : '—' }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            ID #{{ $formateur->id }}
                                        </p>

                                    </div>

                                </div>

                            </td>



                            {{-- =================================================
                                EMAIL
                            ================================================== --}}
                            <td class="px-5 py-4">

                                @if($formateur->email)

                                    <a
                                        href="mailto:{{ $formateur->email }}"
                                        class="inline-flex items-center gap-2 text-sm font-medium text-slate-600 transition hover:text-[#8C4B31]"
                                    >
                                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
                                            <i class="fa-solid fa-envelope text-xs"></i>
                                        </span>

                                        <span>
                                            {{ $formateur->email }}
                                        </span>
                                    </a>

                                @else

                                    <span class="text-sm text-slate-400">
                                        Non renseigné
                                    </span>

                                @endif

                            </td>



                            {{-- =================================================
                                QUALIFICATION
                            ================================================== --}}
                            <td class="px-5 py-4">

                                @if($formateur->qualification)

                                    <span class="inline-flex max-w-[220px] items-center gap-2 rounded-full border border-[#26295C]/10 bg-[#26295C]/5 px-3 py-1.5 text-xs font-bold text-[#26295C]">

                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-[#8C4B31]"></span>

                                        <span class="truncate">
                                            {{ $formateur->qualification }}
                                        </span>

                                    </span>

                                @else

                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">
                                        Non renseignée
                                    </span>

                                @endif

                            </td>



                            {{-- =================================================
                                FORMATIONS ATTRIBUÉES
                            ================================================== --}}
                            <td class="px-5 py-4">

                                @if($formateur->formations && $formateur->formations->count())

                                    <div class="flex max-w-[380px] flex-wrap gap-2">

                                        @foreach($formateur->formations as $formation)

                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-lg border border-[#8C4B31]/10 bg-[#8C4B31]/5 px-2.5 py-1.5 text-xs font-semibold text-[#8C4B31]"
                                                title="{{ $formation->intitule }}"
                                            >
                                                <i class="fa-solid fa-graduation-cap text-[10px]"></i>

                                                <span class="max-w-[180px] truncate">
                                                    {{ $formation->intitule }}
                                                </span>
                                            </span>

                                        @endforeach

                                    </div>

                                @else

                                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-500">
                                        <i class="fa-solid fa-minus text-[10px]"></i>
                                        Aucune
                                    </span>

                                @endif

                            </td>



                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Modifier (Ouvre le modal au lieu d'une redirection) --}}
                                    <button
                                        type="button"
                                        @click="openEditModal(
                                            '{{ route('formateurs.update', $formateur->id) }}',
                                            @js($formateur)
                                        )"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:border-[#26295C]/20 hover:bg-[#26295C] hover:text-white focus:outline-none focus:ring-4 focus:ring-[#26295C]/10"
                                        title="Modifier"
                                        aria-label="Modifier {{ $nomComplet }}"
                                    >
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>


                                    {{-- Supprimer --}}
                                    <button
                                        type="button"
                                        @click="openDeleteModal(
                                            '{{ route('formateurs.destroy', $formateur->id) }}',
                                            @js($nomComplet)
                                        )"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-500 transition hover:border-red-500 hover:bg-red-500 hover:text-white focus:outline-none focus:ring-4 focus:ring-red-100"
                                        title="Supprimer"
                                        aria-label="Supprimer {{ $nomComplet }}"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        {{-- =================================================
                            ÉTAT VIDE
                        ================================================== --}}
                        <tr>

                            <td
                                colspan="5"
                                class="px-5 py-16 text-center"
                            >

                                <div class="mx-auto max-w-md">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#26295C]/10 text-[#26295C]">
                                        <i class="fa-solid fa-user-tie text-2xl"></i>
                                    </div>

                                    <h3 class="mt-5 text-lg font-bold text-slate-800">
                                        Aucun formateur trouvé
                                    </h3>

                                    <p class="mt-2 text-sm leading-6 text-slate-500">
                                        Aucun formateur n'est actuellement enregistré.
                                        Commencez par ajouter votre premier formateur.
                                    </p>

                                    <a
                                        href="{{ route('formateurs.create') }}"
                                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#26295C] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#8C4B31]"
                                    >
                                        <i class="fa-solid fa-user-plus"></i>
                                        Ajouter un Formateur
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>



        {{-- ============================================================
            PAGINATION
        ============================================================= --}}
        @if(method_exists($formateurs, 'links'))

            @if($formateurs->hasPages())

                <div class="border-t border-slate-200 bg-slate-50/50 px-5 py-4 sm:px-6">
                    {{ $formateurs->links() }}
                </div>

            @endif

        @endif

    </div>



    {{-- ================================================================
        MODAL D'ÉDITION DU FORMATEUR
    ================================================================= --}}
    <div
        x-cloak
        x-show="editModalOpen"
        x-transition.opacity
        class="fixed inset-0 z-[100] overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-labelledby="edit-modal-title"
    >
        {{-- Overlay --}}
        <div
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="closeEditModal()"
        ></div>

        {{-- Conteneur --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div
                x-show="editModalOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-4 scale-95 opacity-0"
                x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                x-transition:leave-end="translate-y-4 scale-95 opacity-0"
                @click.stop
                class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl"
            >

                {{-- Barre supérieure --}}
                <div class="h-1.5 bg-[#26295C]"></div>

                <div class="p-6 sm:p-7">

                    {{-- En-tête --}}
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <div>
                                <h2 id="edit-modal-title" class="text-lg font-bold text-[#26295C]">
                                    Modifier le formateur
                                </h2>
                                <p class="text-xs text-slate-500">
                                    Mettre à jour les informations du formateur.
                                </p>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="closeEditModal()"
                            class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-600"
                        >
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>

                    {{-- Formulaire de modification --}}
                    <form
                        method="POST"
                        :action="editUrl"
                        class="mt-6 space-y-4"
                    >
                        @csrf
                        @method('PUT')

                        {{-- Nom & Prénom --}}
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="edit_nom" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                                    Nom
                                </label>
                                <input
                                    type="text"
                                    name="nom"
                                    id="edit_nom"
                                    x-model="editFormateur.nom"
                                    required
                                    class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none focus:ring-2 focus:ring-[#26295C]/10"
                                >
                            </div>

                            <div>
                                <label for="edit_prenom" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                                    Prénom
                                </label>
                                <input
                                    type="text"
                                    name="prenom"
                                    id="edit_prenom"
                                    x-model="editFormateur.prenom"
                                    required
                                    class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none focus:ring-2 focus:ring-[#26295C]/10"
                                >
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="edit_email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                                Adresse Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="edit_email"
                                x-model="editFormateur.email"
                                required
                                class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none focus:ring-2 focus:ring-[#26295C]/10"
                            >
                        </div>

                        {{-- Qualification --}}
                        <div>
                            <label for="edit_qualification" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                                Qualification / Spécialité
                            </label>
                            <input
                                type="text"
                                name="qualification"
                                id="edit_qualification"
                                x-model="editFormateur.qualification"
                                class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none focus:ring-2 focus:ring-[#26295C]/10"
                            >
                        </div>

                        {{-- Actions du formulaire --}}
                        <div class="pt-4 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <button
                                type="button"
                                @click="closeEditModal()"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 focus:outline-none"
                            >
                                Annuler
                            </button>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#26295C] px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31] focus:outline-none"
                            >
                                <i class="fa-solid fa-floppy-disk"></i>
                                Enregistrer
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>



    {{-- ================================================================
        MODAL DE CONFIRMATION DE SUPPRESSION
    ================================================================= --}}
    <div
        x-cloak
        x-show="deleteModalOpen"
        x-transition.opacity
        class="fixed inset-0 z-[100] overflow-y-auto"
        role="dialog"
        aria-modal="true"
        aria-labelledby="delete-modal-title"
    >

        {{-- Overlay --}}
        <div
            class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="closeDeleteModal()"
        ></div>


        {{-- Conteneur --}}
        <div class="relative flex min-h-full items-center justify-center p-4">

            <div
                x-show="deleteModalOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="translate-y-4 scale-95 opacity-0"
                x-transition:enter-end="translate-y-0 scale-100 opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="translate-y-0 scale-100 opacity-100"
                x-transition:leave-end="translate-y-4 scale-95 opacity-0"
                @click.stop
                class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl"
            >

                {{-- Barre supérieure --}}
                <div class="h-1.5 bg-[#8C4B31]"></div>


                <div class="p-6 sm:p-7">

                    {{-- Icône --}}
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-50 text-red-500">
                        <i class="fa-solid fa-trash-can text-xl"></i>
                    </div>


                    {{-- Texte --}}
                    <div class="mt-5">

                        <h2
                            id="delete-modal-title"
                            class="text-xl font-bold text-[#26295C]"
                        >
                            Supprimer le formateur ?
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Vous êtes sur le point de supprimer le formateur
                            <strong
                                class="font-bold text-slate-800"
                                x-text="formateurName"
                            ></strong>.
                        </p>

                        <div class="mt-4 rounded-xl border border-red-100 bg-red-50 p-3.5">

                            <div class="flex items-start gap-2.5">

                                <i class="fa-solid fa-triangle-exclamation mt-0.5 text-red-500"></i>

                                <p class="text-xs leading-5 text-red-700">
                                    Cette action est irréversible. Les informations
                                    associées à ce formateur pourront également être
                                    affectées selon les règles définies par votre application.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Formulaire de suppression --}}
                    <form
                        method="POST"
                        :action="deleteUrl"
                        class="mt-6"
                    >

                        @csrf
                        @method('DELETE')

                        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            {{-- Annuler --}}
                            <button
                                type="button"
                                @click="closeDeleteModal()"
                                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-50 hover:text-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-100"
                            >
                                <i class="fa-solid fa-xmark"></i>
                                Annuler
                            </button>


                            {{-- Confirmer --}}
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-100"
                            >
                                <i class="fa-solid fa-trash"></i>
                                Oui, supprimer
                            </button>

                        </div>

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