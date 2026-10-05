<x-adminLayout>

@php
    // Conversion explicite des IDs en entiers pour in_array
    $formateursSelectionnes = array_map('intval', old('formateurs', $formation->formateurs->pluck('id')->toArray() ?? []));

    $modulesExistants = old(
        'modules',
        $formation->modules->pluck('nom')->toArray()
    );

    if (empty($modulesExistants)) {
        $modulesExistants = [''];
    }

    $dateDebut = old(
        'date_debut',
        \Carbon\Carbon::parse($formation->date_debut)->format('Y-m-d')
    );

    $dateFin = old(
        'date_fin',
        \Carbon\Carbon::parse($formation->date_fin)->format('Y-m-d')
    );
@endphp

<div class="mx-auto w-full max-w-7xl space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <!-- Breadcrumb -->
            <div class="mb-2 flex flex-wrap items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('formations.index') }}" class="transition hover:text-[#26295C]">
                    Formations
                </a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-700">Modifier</span>
            </div>

            <h1 class="text-2xl font-bold text-[#26295C] sm:text-3xl">
                Modifier la Formation : <span class="text-slate-900">{{ $formation->intitule }}</span>
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Modifiez les informations, les dates, les formateurs et les modules associés à cette formation.
            </p>
        </div>

        <a href="{{ route('formations.index') }}" class="inline-flex w-fit items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-[#26295C] hover:bg-slate-50 hover:text-[#26295C]">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à la liste</span>
        </a>
    </div>

    <!-- Affichage des erreurs de validation -->
    @if ($errors->any())
        <div class="p-4 mb-4 bg-red-100 text-red-700 border border-red-400 rounded-xl">
            <p class="font-bold mb-2">Veuillez corriger les erreurs suivantes :</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Affichage des erreurs de session/exception -->
    @if (session('error'))
        <div class="p-4 mb-4 bg-red-100 text-red-700 border border-red-400 rounded-xl">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main Form -->
    <form
        action="{{ route('formations.update', $formation->id) }}"
        method="POST"
        enctype="multipart/form-data"
        x-data="{
            dateDebut: @js($dateDebut),
            dateFin: @js($dateFin),
            duree: {{ old('duree', $formation->duree ?? 0) }},
            modules: @js($modulesExistants),

            calculateDuree() {
                if (!this.dateDebut || !this.dateFin) {
                    this.duree = 0;
                    return;
                }
                const debut = new Date(this.dateDebut);
                const fin = new Date(this.dateFin);
                const difference = fin.getTime() - debut.getTime();
                const jours = Math.ceil(difference / (1000 * 60 * 60 * 24));
                this.duree = jours >= 0 ? jours : 0;
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
    >
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

            <div class="space-y-6 xl:col-span-2">

                <!-- Informations générales -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-slate-900">Informations générales</h2>
                                <p class="text-sm text-slate-500">Informations principales de la formation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        <div class="md:col-span-2">
                            <label for="intitule" class="mb-2 block text-sm font-semibold text-slate-700">
                                Intitulé de la formation <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>
                                <input
                                    type="text"
                                    id="intitule"
                                    name="intitule"
                                    value="{{ old('intitule', $formation->intitule) }}"
                                    required
                                    class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('intitule') border-red-400 @enderror"
                                >
                            </div>
                            @error('intitule')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="categorie" class="mb-2 block text-sm font-semibold text-slate-700">Catégorie</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>
                                <input
                                    type="text"
                                    id="categorie"
                                    name="categorie"
                                    value="{{ old('categorie', $formation->categorie) }}"
                                    placeholder="Ex: Informatique"
                                    class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('categorie') border-red-400 @enderror"
                                >
                            </div>
                            @error('categorie')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="prix" class="mb-2 block text-sm font-semibold text-slate-700">
                                Prix <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                </div>
                                <input
                                    type="number"
                                    id="prix"
                                    name="prix"
                                    value="{{ old('prix', $formation->prix) }}"
                                    min="0"
                                    step="0.01"
                                    required
                                    class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('prix') border-red-400 @enderror"
                                >
                            </div>
                            @error('prix')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="disponible" class="mb-2 block text-sm font-semibold text-slate-700">
                                Disponibilité <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-toggle-on"></i>
                                </div>
                                <select
                                    id="disponible"
                                    name="disponible"
                                    required
                                    class="w-full appearance-none rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-10 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('disponible') border-red-400 @enderror"
                                >
                                    <option value="oui" @selected(old('disponible', $formation->disponible) === 'oui')>Disponible</option>
                                    <option value="non" @selected(old('disponible', $formation->disponible) === 'non')>Non disponible</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                            @error('disponible')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Dates et durée -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-slate-900">Dates et durée</h2>
                                <p class="text-sm text-slate-500">Définissez la période de déroulement de la formation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-3">
                        <div>
                            <label for="date_debut" class="mb-2 block text-sm font-semibold text-slate-700">
                                Date de début <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-calendar-plus"></i>
                                </div>
                                <input
                                    type="date"
                                    id="date_debut"
                                    name="date_debut"
                                    x-model="dateDebut"
                                    @change="calculateDuree()"
                                    required
                                    class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-3 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('date_debut') border-red-400 @enderror"
                                >
                            </div>
                            @error('date_debut')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="date_fin" class="mb-2 block text-sm font-semibold text-slate-700">
                                Date de fin <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <input
                                    type="date"
                                    id="date_fin"
                                    name="date_fin"
                                    x-model="dateFin"
                                    @change="calculateDuree()"
                                    required
                                    class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-3 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('date_fin') border-red-400 @enderror"
                                >
                            </div>
                            @error('date_fin')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="duree" class="mb-2 block text-sm font-semibold text-slate-700">Durée estimée</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <input
                                    type="text"
                                    id="duree"
                                    x-model="duree"
                                    readonly
                                    class="w-full rounded-lg border border-slate-200 bg-slate-50 py-3 pl-10 pr-16 text-sm font-semibold text-[#26295C] outline-none"
                                >
                                <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-xs text-slate-500">jours</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modules -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                    <i class="fa-solid fa-list-check"></i>
                                </div>
                                <div>
                                    <h2 class="font-bold text-slate-900">Modules de la formation</h2>
                                    <p class="text-sm text-slate-500">Gérez les différents modules enseignés.</p>
                                </div>
                            </div>
                            <button
                                type="button"
                                @click="addModule()"
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#8C4B31] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#743d28]"
                            >
                                <i class="fa-solid fa-plus"></i>
                                <span>Ajouter un module</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-3 p-6">
                        <template x-for="(module, index) in modules" :key="index">
                            <div class="flex items-center gap-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-sm font-bold text-[#26295C]">
                                    <span x-text="index + 1"></span>
                                </div>
                                <div class="relative flex-1">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                        <i class="fa-solid fa-book"></i>
                                    </div>
                                    <input
                                        type="text"
                                        name="modules[]"
                                        x-model="modules[index]"
                                        placeholder="Nom du module"
                                        class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10"
                                    >
                                </div>
                                <button
                                    type="button"
                                    @click="removeModule(index)"
                                    :disabled="modules.length === 1"
                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-red-100 bg-red-50 text-red-500 transition hover:bg-red-100 disabled:cursor-not-allowed disabled:opacity-40"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="space-y-6 xl:col-span-1">

                <!-- Image -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#8C4B31] text-white">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-slate-900">Image</h2>
                                <p class="text-sm text-slate-500">Image de présentation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($formation->image)
                            <div class="mb-5">
                                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">Image actuelle</p>
                                <img
                                    src="{{ asset('storage/' . $formation->image) }}"
                                    alt="{{ $formation->intitule }}"
                                    class="h-40 w-full rounded-xl object-cover shadow"
                                >
                            </div>
                        @endif

                        <label for="image" class="mb-2 block text-sm font-semibold text-slate-700">
                            {{ $formation->image ? 'Remplacer l’image' : 'Téléverser une image' }}
                        </label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/*"
                            class="block w-full cursor-pointer rounded-lg border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-[#26295C] file:px-4 file:py-2.5 file:text-sm file:font-semibold file:text-white hover:file:bg-[#1d2048]"
                        >
                        @error('image')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Formateurs -->
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 bg-slate-50 px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#26295C] text-white">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </div>
                            <div>
                                <h2 class="font-bold text-slate-900">Formateurs associés</h2>
                                <p class="text-sm text-slate-500">Sélectionnez les formateurs.</p>
                            </div>
                        </div>
                    </div>

                    <div class="max-h-80 space-y-2 overflow-y-auto p-6">
                        @forelse($formateurs as $formateur)
                            @php
                                $nomComplet = trim(($formateur->prenom ?? '') . ' ' . ($formateur->nom ?? ''));
                            @endphp
                            <label class="flex cursor-pointer items-center gap-3 rounded-lg border border-slate-200 p-3 transition hover:border-[#26295C]/30 hover:bg-slate-50">
                                <input
                                    type="checkbox"
                                    name="formateurs[]"
                                    value="{{ $formateur->id }}"
                                    @checked(in_array((int)$formateur->id, $formateursSelectionnes, true))
                                    class="h-4 w-4 rounded border-slate-300 text-[#26295C] focus:ring-[#26295C]"
                                >
                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#26295C] text-xs font-bold text-white">
                                    {{ strtoupper(substr($formateur->prenom ?? '', 0, 1) . substr($formateur->nom ?? '', 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-sm font-semibold text-slate-800">{{ $nomComplet }}</p>
                                    @if(!empty($formateur->qualification))
                                        <p class="truncate text-xs text-slate-500">{{ $formateur->qualification }}</p>
                                    @endif
                                </div>
                            </label>
                        @empty
                            <p class="text-center text-sm text-slate-500">Aucun formateur disponible.</p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

        <!-- Submit Buttons -->
        <div class="flex flex-col-reverse gap-3 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:flex-row sm:justify-end">
            <a href="{{ route('formations.index') }}" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                <i class="fa-solid fa-xmark"></i>
                <span>Annuler</span>
            </a>
            <button type="submit" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-[#26295C] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1d2048]">
                <i class="fa-solid fa-check"></i>
                <span>Sauvegarder les modifications</span>
            </button>
        </div>

    </form>
</div>

</x-adminLayout>