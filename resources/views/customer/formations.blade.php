<x-customerLayout>
   

    @php
        // Transformation des formations pour inclure explicitement les relations dans le tableau JSON
        $formationsMap = $formations->keyBy('id')->map(function ($formation) {
            return [
                'id' => $formation->id,
                'intitule' => $formation->intitule,
                'description' => $formation->description,
                'duree' => $formation->duree ?? null,
                'prix' => $formation->prix ?? null,
                'modules' => $formation->modules->map(function ($m) {
                    return [
                        'id' => $m->id,
                        'intitule' => $m->intitule ?? $m->titre ?? $m->nom,
                        'description' => $m->description ?? null,
                    ];
                }),
                'formateurs' => $formation->formateurs->map(function ($f) {
                    return [
                        'id' => $f->id,
                        'nom' => $f->nom ?? '',
                        'prenom' => $f->prenom ?? '',
                        'email' => $f->email ?? null,
                        'qualification' => $f->qualification ?? $f->specialite ?? $f->titre ?? 'Formateur MOGA',
                    ];
                }),
            ];
        });
    @endphp

    <div
        x-data="formationApp()"
        class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 space-y-8"
    >

        {{-- EN-TÊTE --}}
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#8C4B31]/10 px-3.5 py-1 text-xs font-bold text-[#8C4B31]">
                <i class="fa-solid fa-graduation-cap"></i>
                Développez vos compétences
            </span>
            <h1 class="text-3xl font-extrabold tracking-tight text-[#26295C] sm:text-4xl">
                Nos Formations Disponibles
            </h1>
            <p class="text-base text-slate-600">
                Découvrez nos programmes de formation certifiants conçus par des experts.
            </p>
        </div>

        {{-- MESSAGES FLASH --}}
        @if(session('success'))
            <div class="max-w-2xl mx-auto rounded-2xl border border-emerald-200 bg-emerald-50 p-4 shadow-sm" role="alert">
                <div class="flex items-center gap-3 text-emerald-800 font-semibold text-sm">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-600"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-2xl mx-auto rounded-2xl border border-amber-200 bg-amber-50 p-4 shadow-sm" role="alert">
                <div class="flex items-center gap-3 text-amber-800 font-semibold text-sm">
                    <i class="fa-solid fa-triangle-exclamation text-lg text-amber-600"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        {{-- GRILLE DE CARDS FORMATIONS --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($formations as $formation)
                <div class="group flex flex-col justify-between overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                    
                    {{-- Contenu supérieur --}}
                    <div class="p-6 space-y-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C] group-hover:bg-[#26295C] group-hover:text-white transition">
                                <i class="fa-solid fa-book-open text-xl"></i>
                            </div>
                            
                            @if(isset($formation->prix))
                                <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 border border-emerald-100">
                                    {{ number_format($formation->prix, 0, ',', ' ') }} RWF
                                </span>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-[#26295C] line-clamp-2">
                                {{ $formation->intitule }}
                            </h3>
                            @if(isset($formation->duree))
                                <p class="mt-1 text-xs text-slate-500 flex items-center gap-1.5">
                                    <i class="fa-regular fa-clock"></i>
                                    Durée : {{ $formation->duree }} jours
                                </p>
                            @endif
                        </div>

                        <p class="text-sm text-slate-600 line-clamp-3">
                            {{ $formation->description ?? 'Aucune description disponible pour cette formation.' }}
                        </p>

                        <hr class="border-slate-100">

                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Formateur(s)</p>
                            @if($formation->formateurs && $formation->formateurs->count())
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($formation->formateurs->take(2) as $f)
                                        <span class="inline-flex items-center gap-1 rounded-md bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-700">
                                            <i class="fa-solid fa-user-tie text-[10px] text-[#8C4B31]"></i>
                                            {{ $f->prenom ?? '' }} {{ $f->nom ?? '' }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-xs italic text-slate-400">Non assigné</p>
                            @endif
                        </div>
                    </div>

                    {{-- Boutons d'action --}}
                    <div class="border-t border-slate-100 bg-slate-50/50 p-4 grid grid-cols-2 gap-3">
                        <button
                            type="button"
                            @click="openDetails({{ $formation->id }})"
                            class="cursor-pointer inline-flex items-center justify-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold text-slate-700 transition hover:bg-slate-100"
                        >
                            <i class="fa-solid fa-circle-info"></i>
                            Détails
                        </button>

                        <button
                            type="button"
                            @click="openRegister({{ $formation->id }}, '{{ addslashes($formation->intitule) }}')"
                            class="cursor-pointer inline-flex items-center justify-center gap-1.5 rounded-xl bg-[#26295C] px-3 py-2 text-xs font-bold text-white transition hover:bg-[#8C4B31]"
                        >
                            <i class="fa-solid fa-user-plus"></i>
                            S'inscrire
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center text-slate-500">
                    Aucune formation disponible pour le moment.
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($formations->hasPages())
            <div class="pt-4">
                {{ $formations->links() }}
            </div>
        @endif


        {{-- ================= MODAL DÉTAILS FORMATION ================= --}}
        <div x-cloak x-show="detailsModalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeDetails()"></div>
            
            <div class="relative flex min-h-full items-center justify-center p-4">
                <div @click.stop class="relative w-full max-w-2xl overflow-hidden rounded-2xl bg-white shadow-2xl">
                    
                    {{-- En-tête --}}
                    <div class="flex items-center justify-between border-b border-slate-100 bg-slate-50 px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#26295C] text-white">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <h2 class="text-lg font-bold text-[#26295C]" x-text="selectedFormation?.intitule"></h2>
                        </div>
                        <button @click="closeDetails()" class="text-slate-400 hover:text-slate-600 transition">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    {{-- Corps du modal --}}
                    <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">
                        
                        {{-- Description --}}
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Description du programme</h4>
                            <p class="text-sm text-slate-700 leading-relaxed" x-text="selectedFormation?.description || 'Aucune description fournie.'"></p>
                        </div>

                        {{-- Infos clés --}}
                        <div class="grid grid-cols-2 gap-4 rounded-xl bg-slate-50 p-4 text-xs">
                            <div>
                                <span class="text-slate-400 block font-bold uppercase">Durée</span>
                                <span class="font-semibold text-slate-800" x-text="selectedFormation?.duree || 'Non spécifiée'"></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-bold uppercase">Prix</span>
                                <span class="font-semibold text-emerald-700" x-text="selectedFormation?.prix ? selectedFormation.prix + ' RWF' : 'Gratuit'"></span>
                            </div>
                        </div>

                        {{-- MODULES --}}
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Modules d'apprentissage</h4>
                            <template x-if="selectedFormation?.modules && selectedFormation.modules.length > 0">
                                <ul class="space-y-2">
                                    <template x-for="(module, index) in selectedFormation.modules" :key="module.id || index">
                                        <li class="flex items-start gap-3 rounded-xl border border-slate-100 p-3 bg-white shadow-sm">
                                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#26295C]/10 text-xs font-bold text-[#26295C]" x-text="index + 1"></span>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800" x-text="module.intitule"></p>
                                                <p class="text-xs text-slate-500 mt-0.5" x-text="module.description"></p>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </template>
                            <template x-if="!selectedFormation?.modules || selectedFormation.modules.length === 0">
                                <p class="text-xs italic text-slate-400">Aucun module disponible pour cette formation.</p>
                            </template>
                        </div>

                        {{-- FORMATEURS (Nom, Prénom, Email, Qualification) --}}
                        <div>
                            <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Formateur(s) Associé(s)</h4>
                            <template x-if="selectedFormation?.formateurs && selectedFormation.formateurs.length > 0">
                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                    <template x-for="formateur in selectedFormation.formateurs" :key="formateur.id">
                                        <div class="flex items-start gap-3 rounded-xl border border-slate-100 p-3.5 bg-slate-50/50">
                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#8C4B31]/10 text-[#8C4B31] font-bold">
                                                <i class="fa-solid fa-user-tie text-base"></i>
                                            </div>
                                            <div class="space-y-1 min-w-0">
                                                {{-- Nom & Prénom --}}
                                                <p class="text-sm font-bold text-slate-800 truncate" x-text="(formateur.prenom || '') + ' ' + (formateur.nom || '')"></p>
                                                
                                                {{-- Qualification / Spécialité --}}
                                                <p class="text-xs font-medium text-[#8C4B31] flex items-center gap-1 truncate">
                                                    <i class="fa-solid fa-certificate text-[10px]"></i>
                                                    <span x-text="formateur.qualification"></span>
                                                </p>

                                                {{-- Email --}}
                                                <template x-if="formateur.email">
                                                    <p class="text-xs text-slate-500 flex items-center gap-1.5 truncate">
                                                        <i class="fa-regular fa-envelope text-[11px] text-slate-400"></i>
                                                        <span x-text="formateur.email"></span>
                                                    </p>
                                                </template>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </template>
                            <template x-if="!selectedFormation?.formateurs || selectedFormation.formateurs.length === 0">
                                <p class="text-xs italic text-slate-400">Aucun formateur n'a encore été attribué à cette formation.</p>
                            </template>
                        </div>

                    </div>

                    {{-- Pied du modal --}}
                    <div class="border-t border-slate-100 bg-slate-50 px-6 py-4 flex items-center justify-end gap-3">
                        <button type="button" @click="closeDetails()" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-100">
                            Fermer
                        </button>
                        <button 
                            type="button" 
                            @click="
                                const id = selectedFormation.id;
                                const title = selectedFormation.intitule;
                                closeDetails();
                                openRegister(id, title);
                            "
                            class="rounded-xl bg-[#26295C] px-5 py-2 text-sm font-bold text-white hover:bg-[#8C4B31] transition"
                        >
                            S'inscrire à cette formation
                        </button>
                    </div>

                </div>
            </div>
        </div>


        {{-- ================= MODAL INSCRIPTION ================= --}}
        <div x-cloak x-show="registerModalOpen" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto">
            <div class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm" @click="closeRegister()"></div>

            <div class="relative flex min-h-full items-center justify-center p-4">
                <div @click.stop class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">
                    
                    {{-- En-tête --}}
                    <div class="bg-[#26295C] p-6 text-white">
                        <h3 class="text-lg font-bold">Inscription à la formation</h3>
                        <p class="mt-1 text-xs text-slate-200" x-text="formationTitle"></p>
                    </div>

                    {{-- Formulaire --}}
                    <form :action="registerUrl" method="POST" class="p-6 space-y-4">
                        @csrf

                        {{-- Nom & Prénom --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Nom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nom" required placeholder="Votre nom" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Prénom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="prenom" required placeholder="Votre prénom" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none">
                            </div>
                        </div>

                        {{-- Email & Téléphone --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Adresse Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" required placeholder="exemple@email.com" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                    Téléphone
                                </label>
                                <input type="tel" name="telephone" placeholder="+250 78X XXX XXX" class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none">
                            </div>
                        </div>

                        {{-- Domaine --}}
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                Domaine d'études / d'activité <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="domaine" required placeholder="Ex: Informatique, Gestion, Marketing..." class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm focus:border-[#26295C] focus:outline-none">
                        </div>

                        {{-- Occupation (Enum) --}}
                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">
                                Occupation Actuelle <span class="text-red-500">*</span>
                            </label>
                            <select name="occupation" required class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-sm bg-white focus:border-[#26295C] focus:outline-none">
                                <option value="" disabled selected>Sélectionnez votre occupation</option>
                                <option value="Eleve">Élève</option>
                                <option value="Etudiant">Étudiant</option>
                                <option value="Jeune Professionel">Jeune Professionnel</option>
                                <option value="Chomeur">Chômeur</option>
                                <option value="Professionel experimente">Professionnel expérimenté</option>
                            </select>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                            <button type="button" @click="closeRegister()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-50">
                                Annuler
                            </button>
                            <button type="submit" class="rounded-xl bg-[#26295C] px-5 py-2 text-sm font-bold text-white hover:bg-[#8C4B31] transition">
                                Confirmer mon inscription
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <script>
    function formationApp() {
        return {
            formations: @js($formationsMap),
            detailsModalOpen: false,
            selectedFormation: null,
            registerModalOpen: false,
            registerUrl: '',
            formationTitle: '',

            openDetails(id) {
                this.selectedFormation = this.formations[id] || null;
                if (this.selectedFormation) {
                    this.detailsModalOpen = true;
                }
            },

            closeDetails() {
                this.detailsModalOpen = false;
                this.selectedFormation = null;
            },

            openRegister(id, title) {
                this.registerUrl = '{{ url('/formations') }}/' + id + '/inscription';
                this.formationTitle = title;
                this.registerModalOpen = true;
            },

            closeRegister() {
                this.registerModalOpen = false;
                this.registerUrl = '';
                this.formationTitle = '';
            }
        }
    }
    </script>

    <style>
        [x-cloak] { display: none !important; }
    </style>



</x-customerLayout>