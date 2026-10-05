<x-adminLayout>

<div 
    x-data="{ imagePreview: null }"
    class="mx-auto w-full max-w-4xl space-y-6"
>
    {{-- EN-TÊTE ET RETOUR --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            <a 
                href="{{ route('annonces.index') }}" 
                class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-sm transition hover:bg-slate-50"
                title="Retour à la liste"
            >
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-[#26295C]">
                    Créer une nouvelle annonce
                </h1>
                <p class="mt-0.5 text-sm text-slate-500">
                    Remplissez les informations ci-dessous pour publier une nouvelle annonce.
                </p>
            </div>
        </div>
    </div>

    {{-- CARD FORMULAIRE --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-100 bg-slate-50/50 px-6 py-4">
            <h2 class="font-bold text-[#26295C]">Informations de l'annonce</h2>
        </div>

        <form 
            action="{{ route('annonces.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="p-6 space-y-6"
        >
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                {{-- TITRE --}}
                <div class="space-y-1.5">
                    <label for="titre" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Titre de l'annonce <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="titre" 
                        name="titre" 
                        value="{{ old('titre') }}"
                        placeholder="Ex: Ouverture des inscriptions 2026..." 
                        required
                        class="w-full rounded-xl border @error('titre') border-red-500 @else border-slate-200 @enderror px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('titre')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CATÉGORIE --}}
                <div class="space-y-1.5">
                    <label for="categorie" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                        Catégorie <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="categorie" 
                        name="categorie" 
                        value="{{ old('categorie') }}"
                        placeholder="Ex: Événement, Formation, Urgent..." 
                        required
                        class="w-full rounded-xl border @error('categorie') border-red-500 @else border-slate-200 @enderror px-3.5 py-2.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                    >
                    @error('categorie')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="space-y-1.5">
                <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                    Description complète <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="5" 
                    placeholder="Saisissez les détails de l'annonce..." 
                    required
                    class="w-full rounded-xl border @error('description') border-red-500 @else border-slate-200 @enderror p-3.5 text-sm transition focus:border-[#26295C] focus:outline-none focus:ring-1 focus:ring-[#26295C]"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- IMAGE AVEC PRÉVISUALISATION --}}
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">
                    Image d'illustration <span class="text-xs normal-case text-slate-400">(Optionnelle, max 2Mo)</span>
                </label>

                <div class="flex flex-col sm:flex-row items-start gap-4">
                    {{-- Zone d'aperçu d'image --}}
                    <div class="relative h-32 w-48 shrink-0 overflow-hidden rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 flex items-center justify-center">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!imagePreview">
                            <div class="text-center text-slate-400 p-2">
                                <i class="fa-solid fa-cloud-arrow-up text-2xl mb-1"></i>
                                <p class="text-xs">Aperçu de l'image</p>
                            </div>
                        </template>
                    </div>

                    {{-- Champ Fichier --}}
                    <div class="flex-1 space-y-2 w-full">
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            accept="image/*"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => { imagePreview = e.target.result; };
                                    reader.readAsDataURL(file);
                                }
                            "
                            class="block w-full text-xs text-slate-500 file:mr-4 file:rounded-xl file:border-0 file:bg-[#26295C]/10 file:px-4 file:py-2.5 file:text-xs file:font-bold file:text-[#26295C] hover:file:bg-[#26295C]/20"
                        >
                        <p class="text-xs text-slate-400">Formats acceptés : PNG, JPG, JPEG, GIF, WEBP.</p>
                        @error('image')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- BOUTONS D'ACTION --}}
            <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                <a 
                    href="{{ route('annonces.index') }}" 
                    class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50"
                >
                    Annuler
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center gap-2 rounded-xl bg-[#26295C] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#8C4B31]"
                >
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    Publier l'annonce
                </button>
            </div>
        </form>
    </div>
</div>

</x-adminLayout>