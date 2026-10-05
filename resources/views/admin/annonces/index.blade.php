<x-adminLayout>

<div
    x-data="{
        deleteModalOpen: false,
        deleteUrl: '',
        annonceTitre: '',

        editModalOpen: false,
        editUrl: '',
        editAnnonce: {
            id: '',
            titre: '',
            description: '',
            categorie: '',
            image: ''
        },

        openDeleteModal(url, titre) {
            this.deleteUrl = url;
            this.annonceTitre = titre;
            this.deleteModalOpen = true;
        },

        closeDeleteModal() {
            this.deleteModalOpen = false;
            this.deleteUrl = '';
            this.annonceTitre = '';
        },

        openEditModal(url, annonce) {
            this.editUrl = url;
            this.editAnnonce = {
                id: annonce.id,
                titre: annonce.titre || '',
                description: annonce.description || '',
                categorie: annonce.categorie || '',
                image: annonce.image || ''
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

    {{-- EN-TÊTE --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-bullhorn text-lg"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                        Gestion des Annonces
                    </h1>
                    <p class="mt-1 text-sm text-slate-500">
                        Gérez les actualités, événements et communications de la plateforme.
                    </p>
                </div>
            </div>
        </div>

        <a
            href="{{ route('annonces.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#26295C] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31]"
        >
            <i class="fa-solid fa-plus"></i>
            Créer une Annonce
        </a>
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

    {{-- TABLEAU PRINCIPAL --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-[#26295C]">Liste des annonces</h2>
                <span class="rounded-lg bg-[#26295C]/10 px-3 py-1 text-xs font-bold text-[#26295C]">
                    {{ $annonces->count() }} enregistrées
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-[1000px] w-full text-left">
                <thead class="border-b border-slate-200 bg-white">
                    <tr>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Image</th>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Titre & Catégorie</th>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Description</th>
                        <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($annonces as $annonce)
                        <tr class="transition hover:bg-slate-50/70">
                            {{-- Image --}}
                            <td class="px-5 py-4">
                                @if($annonce->image)
                                    <img 
                                        src="{{ asset('storage/' . $annonce->image) }}" 
                                        alt="{{ $annonce->titre }}" 
                                        class="h-14 w-20 rounded-lg object-cover border border-slate-200"
                                    >
                                @else
                                    <div class="flex h-14 w-20 items-center justify-center rounded-lg bg-slate-100 text-slate-400">
                                        <i class="fa-solid fa-image text-xl"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Titre & Catégorie --}}
                            <td class="px-5 py-4">
                                <p class="text-sm font-bold text-slate-800">{{ $annonce->titre }}</p>
                                @if($annonce->categorie)
                                    <span class="mt-1 inline-flex items-center rounded-md bg-[#26295C]/10 px-2 py-0.5 text-xs font-semibold text-[#26295C]">
                                        {{ $annonce->categorie }}
                                    </span>
                                @endif
                            </td>

                            {{-- Description --}}
                            <td class="px-5 py-4">
                                <p class="max-w-md truncate text-sm text-slate-600" title="{{ $annonce->description }}">
                                    {{ $annonce->description }}
                                </p>
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        @click="openEditModal('{{ route('annonces.update', $annonce->id) }}', @js($annonce))"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:bg-[#26295C] hover:text-white"
                                        title="Modifier"
                                    >
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>

                                    <button
                                        type="button"
                                        @click="openDeleteModal('{{ route('annonces.destroy', $annonce->id) }}', @js($annonce->titre))"
                                        class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white"
                                        title="Supprimer"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-slate-500">
                                Aucune annonce enregistrée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL D'ÉDITION --}}
    <div x-cloak x-show="editModalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeEditModal()"></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div @click.stop class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">
                <div class="h-1.5 bg-[#26295C]"></div>
                <div class="p-6">
                    <h2 class="text-lg font-bold text-[#26295C]">Modifier l'annonce</h2>

                    <form method="POST" :action="editUrl" enctype="multipart/form-data" class="mt-4 space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Titre</label>
                            <input type="text" name="titre" x-model="editAnnonce.titre" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#26295C] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Catégorie</label>
                            <input type="text" name="categorie" x-model="editAnnonce.categorie" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#26295C] focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Description</label>
                            <textarea name="description" x-model="editAnnonce.description" rows="3" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2 text-sm focus:border-[#26295C] focus:outline-none"></textarea>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Nouvelle Image (optionnelle)</label>
                            <input type="file" name="image" class="w-full rounded-xl border border-slate-200 px-3 py-1.5 text-xs">
                        </div>

                        <div class="flex justify-end gap-3 pt-3">
                            <button type="button" @click="closeEditModal()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600">Annuler</button>
                            <button type="submit" class="rounded-xl bg-[#26295C] px-4 py-2 text-sm font-bold text-white hover:bg-[#8C4B31]">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DE SUPPRESSION --}}
    <div x-cloak x-show="deleteModalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeDeleteModal()"></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div @click.stop class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl p-6">
                <h2 class="text-xl font-bold text-[#26295C]">Supprimer l'annonce ?</h2>
                <p class="mt-2 text-sm text-slate-500">Êtes-vous sûr de vouloir supprimer <strong x-text="annonceTitre"></strong> ?</p>

                <form method="POST" :action="deleteUrl" class="mt-6 flex justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="closeDeleteModal()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600">Annuler</button>
                    <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-bold text-white hover:bg-red-700">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>

</x-adminLayout>