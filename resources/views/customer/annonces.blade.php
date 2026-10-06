<x-customerLayout>

    <div
        x-data="annonceApp()"
        class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 space-y-8"
    >

        {{-- EN-TÊTE DE SECTION --}}
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#8C4B31]/10 px-3.5 py-1 text-xs font-bold text-[#8C4B31]">
                <i class="fa-solid fa-bullhorn"></i>
                Actualités & Inquisitions
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#26295C] sm:text-4xl">
                Annonces & Communiqués
            </h1>
            <p class="text-base text-slate-600">
                Restez informé des dernières nouveautés, événements et opportunités.
            </p>
        </div>

        {{-- FILTRE PAR CATÉGORIE --}}
        @if($categories->count() > 0)
            <div class="flex flex-wrap items-center justify-center gap-2">
                <a 
                    href="{{ route('trainee.annonces.index') }}" 
                    class="rounded-xl px-4 py-2 text-xs font-bold transition {{ !request('categorie') ? 'bg-[#26295C] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                >
                    Toutes
                </a>
                @foreach($categories as $cat)
                    <a 
                        href="{{ route('trainee.annonces.index', ['categorie' => $cat]) }}" 
                        class="rounded-xl px-4 py-2 text-xs font-bold transition {{ request('categorie') === $cat ? 'bg-[#26295C] text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                    >
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- GRILLE DES CARDS ANNONCES --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($annonces as $annonce)
                <div class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                    
                    <div>
                        {{-- IMAGE DE L'ANNONCE --}}
                        <div class="relative h-48 w-full overflow-hidden bg-slate-100">
                            @if($annonce->image)
                                <img 
                                    src="{{ asset('storage/' . $annonce->image) }}" 
                                    alt="{{ $annonce->titre }}" 
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-105"
                                >
                            @else
                                {{-- Image par défaut --}}
                                <div class="flex h-full w-full items-center justify-center bg-[#26295C]/5 text-[#26295C]">
                                    <i class="fa-solid fa-newspaper text-4xl opacity-40"></i>
                                </div>
                            @endif

                            {{-- BADGE CATÉGORIE --}}
                            @if($annonce->categorie)
                                <span class="absolute top-3 left-3 rounded-lg bg-[#26295C]/90 px-3 py-1 text-[11px] font-bold text-white backdrop-blur-sm shadow-sm">
                                    {{ $annonce->categorie }}
                                </span>
                            @endif
                        </div>

                        {{-- CONTENU DE LA CARD --}}
                        <div class="p-6 space-y-3">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <i class="fa-regular fa-calendar-days text-[#8C4B31]"></i>
                                <span>{{ $annonce->created_at->translatedFormat('d F Y') }}</span>
                            </div>

                            <h3 class="text-lg font-bold text-[#26295C] line-clamp-2">
                                {{ $annonce->titre }}
                            </h3>

                            <p class="text-sm text-slate-600 line-clamp-3">
                                {{ $annonce->description }}
                            </p>
                        </div>
                    </div>

                    {{-- PIED DE CARD : BOUTON LIRE PLUS --}}
                    <div class="border-t border-slate-100 bg-slate-50/50 p-4">
                        <button
                            type="button"
                            @click="openModal({{ $annonce->id }})"
                            class="cursor-pointer w-full inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-bold text-slate-700 transition hover:bg-[#26295C] hover:text-white"
                        >
                            <span>Lire l'annonce</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-500">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-4">
                        <i class="fa-solid fa-bullhorn text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700">Aucune annonce publiée</h3>
                    <p class="text-sm text-slate-500 mt-1">Revenez plus tard pour consulter les nouveaux communiqués.</p>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($annonces->hasPages())
            <div class="pt-4">
                {{ $annonces->links() }}
            </div>
        @endif


        {{-- ================= MODAL LECTURE ANNONCE ================= --}}
        <div x-cloak x-show="modalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeModal()"></div>

            <div class="relative flex min-h-full items-center justify-center p-4">
                <div @click.stop class="relative w-full max-w-2xl overflow-hidden rounded-2xl bg-white shadow-2xl">
                    
                    {{-- Image dans le modal (si présente) --}}
                    <template x-if="selectedAnnonce?.image">
                        <div class="relative h-56 w-full overflow-hidden bg-slate-100">
                            <img 
                                :src="'/storage/' + selectedAnnonce.image" 
                                :alt="selectedAnnonce.titre" 
                                class="h-full w-full object-cover"
                            >
                            <button @click="closeModal()" class="absolute top-4 right-4 flex h-8 w-8 items-center justify-center rounded-full bg-black/50 text-white hover:bg-black/80 transition">
                                <i class="fa-solid fa-xmark text-lg"></i>
                            </button>
                        </div>
                    </template>

                    {{-- En-tête si pas d'image --}}
                    <template x-if="!selectedAnnonce?.image">
                        <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-6 py-4">
                            <span class="text-xs font-bold uppercase tracking-wider text-[#8C4B31]" x-text="selectedAnnonce?.categorie || 'Annonce'"></span>
                            <button @click="closeModal()" class="text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-xmark text-xl"></i>
                            </button>
                        </div>
                    </template>

                    {{-- Contenu du modal --}}
                    <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                        <div>
                            <template x-if="selectedAnnonce?.categorie && selectedAnnonce?.image">
                                <span class="inline-block rounded-md bg-[#8C4B31]/10 px-2.5 py-1 text-xs font-bold text-[#8C4B31] mb-2" x-text="selectedAnnonce.categorie"></span>
                            </template>
                            <h2 class="text-xl font-bold text-[#26295C]" x-text="selectedAnnonce?.titre"></h2>
                            <p class="text-xs text-slate-400 mt-1 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock"></i>
                                Publié le <span x-text="selectedAnnonce?.created_at_formatted"></span>
                            </p>
                        </div>

                        <hr class="border-slate-100">

                        <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line" x-text="selectedAnnonce?.description"></div>
                    </div>

                    {{-- Pied du modal --}}
                    <div class="border-t border-slate-100 bg-slate-50 px-6 py-4 flex items-center justify-end">
                        <button type="button" @click="closeModal()" class="rounded-xl border border-slate-200 bg-white px-5 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100 transition">
                            Fermer
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @php
        // Indexation des annonces pour le composant JS avec la date formatée
        $annoncesMap = $annonces->keyBy('id')->map(function($item) {
            return [
                'id' => $item->id,
                'titre' => $item->titre,
                'description' => $item->description,
                'image' => $item->image,
                'categorie' => $item->categorie,
                'created_at_formatted' => $item->created_at ? $item->created_at->translatedFormat('d F Y') : '',
            ];
        });
    @endphp

    <script>
    function annonceApp() {
        return {
            annonces: @js($annoncesMap),
            modalOpen: false,
            selectedAnnonce: null,

            openModal(id) {
                this.selectedAnnonce = this.annonces[id] || null;
                if (this.selectedAnnonce) {
                    this.modalOpen = true;
                }
            },

            closeModal() {
                this.modalOpen = false;
                this.selectedAnnonce = null;
            }
        }
    }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>


</x-customerLayout>