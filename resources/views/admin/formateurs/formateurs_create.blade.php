<x-adminLayout>

<div class="mx-auto w-full max-w-4xl">

    <!-- Header -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <a
                    href="{{ route('formateurs.index') }}"
                    class="transition hover:text-[#26295C]"
                >
                    Formateurs
                </a>

                <i class="fa-solid fa-chevron-right text-xs"></i>

                <span class="text-slate-700">
                    Ajouter
                </span>
            </div>

            <h1 class="text-2xl font-bold text-[#26295C] sm:text-3xl">
                Ajouter un Formateur
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Ajoutez un nouveau formateur au personnel du Centre de Formation MOGA Initiative.
            </p>
        </div>

        <!-- Retour -->
        <a
            href="{{ route('formateurs.index') }}"
            class="inline-flex w-fit items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-[#26295C] hover:bg-slate-50 hover:text-[#26295C]"
        >
            <i class="fa-solid fa-arrow-left"></i>
            <span>Retour à la liste</span>
        </a>

    </div>


    <!-- Form Card -->
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <!-- Card Header -->
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-5 sm:px-8">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C] text-white">
                    <i class="fa-solid fa-user-plus text-lg"></i>
                </div>

                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Informations du formateur
                    </h2>

                    <p class="text-sm text-slate-500">
                        Renseignez les informations personnelles et professionnelles.
                    </p>
                </div>

            </div>
        </div>


        <!-- Form -->
        <form
            action="{{ route('formateurs.store') }}"
            method="POST"
            class="p-6 sm:p-8"
        >
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <!-- Nom -->
                <div>
                    <label
                        for="nom"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nom <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <input
                            type="text"
                            id="nom"
                            name="nom"
                            value="{{ old('nom') }}"
                            required
                            autocomplete="family-name"
                            placeholder="Ex: UWIMANA"
                            class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('nom') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                    </div>

                    @error('nom')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Prénom -->
                <div>
                    <label
                        for="prenom"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Prénom <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <input
                            type="text"
                            id="prenom"
                            name="prenom"
                            value="{{ old('prenom') }}"
                            required
                            autocomplete="given-name"
                            placeholder="Ex: Jean"
                            class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('prenom') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                    </div>

                    @error('prenom')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Email -->
                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Adresse Email <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-envelope"></i>
                        </div>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="Ex: jean.uwimana@example.com"
                            class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('email') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                    </div>

                    @error('email')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                <!-- Qualification -->
                <div>
                    <label
                        for="qualification"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Qualification / Spécialité <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>

                        <input
                            type="text"
                            id="qualification"
                            name="qualification"
                            value="{{ old('qualification') }}"
                            placeholder="Ex: Expert Laravel & Cloud Architecture"
                            required
                            autocomplete="organization-title"
                            class="w-full rounded-lg border border-slate-300 bg-white py-3 pl-10 pr-4 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-[#26295C] focus:ring-4 focus:ring-[#26295C]/10 @error('qualification') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        >
                    </div>

                    @error('qualification')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>


            <!-- Required Fields Notice -->
            <div class="mt-6 flex items-start gap-3 rounded-lg border border-[#8C4B31]/20 bg-[#8C4B31]/5 px-4 py-3">
                <i class="fa-solid fa-circle-info mt-0.5 text-[#8C4B31]"></i>

                <p class="text-xs leading-5 text-slate-600">
                    Les champs marqués d'un
                    <span class="font-semibold text-red-500">*</span>
                    sont obligatoires.
                    Vérifiez l'adresse email avant d'enregistrer le formateur.
                </p>
            </div>


            <!-- Actions -->
            <div class="mt-8 flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                <!-- Annuler -->
                <a
                    href="{{ route('formateurs.index') }}"
                    class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <i class="fa-solid fa-xmark"></i>
                    <span>Annuler</span>
                </a>

                <!-- Submit -->
                <button
                    type="submit"
                    class="inline-flex min-h-11 items-center justify-center gap-2 rounded-lg bg-[#26295C] px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#1d2048] focus:outline-none focus:ring-4 focus:ring-[#26295C]/20"
                >
                    <i class="fa-solid fa-check"></i>
                    <span>Enregistrer le Formateur</span>
                </button>

            </div>

        </form>

    </div>

</div>


</x-adminLayout>