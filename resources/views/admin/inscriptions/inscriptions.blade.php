<x-adminLayout>

<div
    x-data="{
        deleteModalOpen: false,
        deleteUrl: '',
        eleveNom: '',

        openDeleteModal(url, nom) {
            this.deleteUrl = url;
            this.eleveNom = nom;
            this.deleteModalOpen = true;
        },

        closeDeleteModal() {
            this.deleteModalOpen = false;
            this.deleteUrl = '';
            this.eleveNom = '';
        }
    }"
    @keydown.escape.window="closeDeleteModal()"
    class="mx-auto w-full max-w-7xl space-y-6"
>

    {{-- EN-TÊTE --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                <i class="fa-solid fa-user-graduate text-lg"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                    Inscriptions & Élèves
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Consultez la liste des élèves (clients) inscrits aux différentes formations.
                </p>
            </div>
        </div>

        <span class="rounded-xl bg-[#26295C]/10 px-4 py-2 text-sm font-bold text-[#26295C]">
            Total : {{ $inscriptions->count() }} inscription(s)
        </span>
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
            <h2 class="font-bold text-[#26295C]">Élèves inscrits aux formations</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-[900px] w-full text-left">
                <thead class="border-b border-slate-200 bg-white">
                    <tr>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Élève</th>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Contact / Email</th>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Formation choisie</th>
                        <th class="px-5 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">Date d'inscription</th>
                        <th class="px-5 py-4 text-right text-xs font-bold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($inscriptions as $item)
                        @php
                            $nomComplet = trim(($item->prenom ?? '') . ' ' . ($item->nom ?? 'Client #' . $item->client_id));
                        @endphp
                        <tr class="transition hover:bg-slate-50/70">
                            {{-- Nom Élève --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#26295C]/10 text-sm font-bold text-[#26295C]">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $nomComplet }}</p>
                                        <p class="text-xs text-slate-400">ID Client #{{ $item->client_id }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Contact --}}
                            <td class="px-5 py-4">
                                <p class="text-sm font-medium text-slate-700">{{ $item->email ?? 'N/A' }}</p>
                                @if(isset($item->telephone))
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $item->telephone }}</p>
                                @endif
                            </td>

                            {{-- Formation --}}
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 rounded-lg border border-[#8C4B31]/10 bg-[#8C4B31]/5 px-2.5 py-1 text-xs font-bold text-[#8C4B31]">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    {{ $item->formation_intitule }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td class="px-5 py-4 text-xs font-medium text-slate-500">
                                {{ $item->date_inscription ? \Carbon\Carbon::parse($item->date_inscription)->format('d/m/Y H:i') : 'N/A' }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right">
                                <button
                                    type="button"
                                    @click="openDeleteModal('{{ route('inscriptions.destroy', $item->inscription_id) }}', @js($nomComplet))"
                                    class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-500 hover:text-white"
                                    title="Désinscrire l'élève"
                                >
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                                Aucune inscription enregistrée dans la base de données.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL SUPPRESSION --}}
    <div x-cloak x-show="deleteModalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
        <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeDeleteModal()"></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div @click.stop class="relative w-full max-w-md overflow-hidden rounded-2xl bg-white p-6 shadow-2xl">
                <h2 class="text-xl font-bold text-[#26295C]">Désinscrire l'élève ?</h2>
                <p class="mt-2 text-sm text-slate-500">Êtes-vous sûr de vouloir retirer l'inscription de <strong x-text="eleveNom"></strong> de cette formation ?</p>

                <form method="POST" :action="deleteUrl" class="mt-6 flex justify-end gap-3">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="closeDeleteModal()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600">Annuler</button>
                    <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-bold text-white hover:bg-red-700">Désinscrire</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
</style>

</x-adminLayout>