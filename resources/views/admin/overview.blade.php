<x-adminLayout>


<div class="min-h-screen bg-[#F8FAFC] px-4 py-6 sm:px-6 lg:px-8">

{{-- =========================================================
    PAGE HEADER
========================================================== --}}
<div class="mb-8 flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

    <div>
        <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">
            <i class="fa-solid fa-house"></i>
            <span>/</span>
            <span>Tableau de bord</span>
        </div>

        <h1 class="text-2xl font-extrabold tracking-tight text-[#26295C] sm:text-3xl">
            Bonjour, Administrateur 👋
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Voici un aperçu de l'activité du Centre de Formation MOGA Initiative.
        </p>

        <p class="mt-2 flex items-center gap-2 text-xs font-medium text-gray-400">
            <i class="fa-regular fa-calendar"></i>
            {{ now()->locale('fr')->translatedFormat('l d F Y') }}
        </p>
    </div>

    <a
        href=""
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#8C4B31] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#743D29] focus:outline-none focus:ring-4 focus:ring-[#8C4B31]/20"
    >
        <i class="fa-solid fa-bullhorn"></i>
        Publier une annonce
    </a>

</div>


{{-- =========================================================
    KPI CARDS
========================================================== --}}
<div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

    {{-- Formations --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500">
                    Formations actives
                </p>

                <p class="mt-2 text-3xl font-extrabold text-[#26295C]">
                    {{ $stats['formations_disponibles'] ?? 0 }}
                </p>

                <p class="mt-2 text-xs text-gray-400">
                    Formations actuellement disponibles
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                <i class="fa-solid fa-graduation-cap text-xl"></i>
            </div>
        </div>
    </div>


    {{-- Clients --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500">
                    Total élèves / clients
                </p>

                <p class="mt-2 text-3xl font-extrabold text-[#26295C]">
                    {{ $stats['total_clients'] ?? 0 }}
                </p>

                <p class="mt-2 text-xs text-gray-400">
                    Participants enregistrés
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <i class="fa-solid fa-users text-xl"></i>
            </div>
        </div>
    </div>


    {{-- Formateurs --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500">
                    Formateurs
                </p>

                <p class="mt-2 text-3xl font-extrabold text-[#26295C]">
                    {{ $stats['total_formateurs'] ?? 0 }}
                </p>

                <p class="mt-2 text-xs text-gray-400">
                    Formateurs enregistrés
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <i class="fa-solid fa-chalkboard-user text-xl"></i>
            </div>
        </div>
    </div>


    {{-- Annonces --}}
    <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500">
                    Annonces
                </p>

                <p class="mt-2 text-3xl font-extrabold text-[#26295C]">
                    {{ $stats['total_annonces'] ?? 0 }}
                </p>

                <p class="mt-2 text-xs text-gray-400">
                    Publications disponibles
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31]">
                <i class="fa-solid fa-bullhorn text-xl"></i>
            </div>
        </div>
    </div>

</div>


{{-- =========================================================
    QUICK ACTIONS
========================================================== --}}
<div class="mb-8 rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6">

    <div class="mb-5">
        <h2 class="text-lg font-extrabold text-[#26295C]">
            Actions rapides
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Accédez rapidement aux principales fonctionnalités d'administration.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

        <a
            href=""
            class="group flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-[#26295C]/30 hover:bg-[#26295C]/5"
        >
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C] transition group-hover:bg-[#26295C] group-hover:text-white">
                <i class="fa-solid fa-plus"></i>
            </span>

            <div>
                <p class="text-sm font-bold text-gray-800">
                    Ajouter Formation
                </p>
                <p class="text-xs text-gray-500">
                    Créer une formation
                </p>
            </div>
        </a>


        <a
            href=""
            class="group flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-emerald-200 hover:bg-emerald-50"
        >
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">
                <i class="fa-solid fa-user-plus"></i>
            </span>

            <div>
                <p class="text-sm font-bold text-gray-800">
                    Ajouter Formateur
                </p>
                <p class="text-xs text-gray-500">
                    Enregistrer un formateur
                </p>
            </div>
        </a>


        <a
            href=""
            class="group flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-[#8C4B31]/30 hover:bg-[#8C4B31]/5"
        >
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31] transition group-hover:bg-[#8C4B31] group-hover:text-white">
                <i class="fa-solid fa-bullhorn"></i>
            </span>

            <div>
                <p class="text-sm font-bold text-gray-800">
                    Créer Annonce
                </p>
                <p class="text-xs text-gray-500">
                    Publier une actualité
                </p>
            </div>
        </a>


        <a
            href=""
            class="group flex items-center gap-4 rounded-xl border border-gray-200 p-4 transition hover:border-blue-200 hover:bg-blue-50"
        >
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                <i class="fa-solid fa-clipboard-list"></i>
            </span>

            <div>
                <p class="text-sm font-bold text-gray-800">
                    Voir Inscriptions
                </p>
                <p class="text-xs text-gray-500">
                    Gérer les inscriptions
                </p>
            </div>
        </a>

    </div>
</div>


{{-- =========================================================
    MAIN GRID
========================================================== --}}
<div class="mb-8 grid grid-cols-1 gap-6 xl:grid-cols-2">

    {{-- =====================================================
        RECENT CLIENTS
    ====================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="flex flex-col gap-3 border-b border-gray-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div>
                <h2 class="text-lg font-extrabold text-[#26295C]">
                    Dernières inscriptions
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Les 6 derniers clients inscrits
                </p>
            </div>

            <a
                href=""
                class="inline-flex items-center gap-1 text-sm font-bold text-[#8C4B31] hover:text-[#743D29]"
            >
                Voir tout
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left">

                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-5 py-3 font-bold">Client</th>
                        <th class="px-5 py-3 font-bold">Domaine</th>
                        <th class="px-5 py-3 font-bold">Occupation</th>
                        <th class="px-5 py-3 font-bold">Formation</th>
                        <th class="px-5 py-3 font-bold">Date</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($recentClients as $client)

                        @php
                            $occupation = strtolower($client->occupation ?? '');

                            $occupationClasses = match ($occupation) {
                                'eleve' => 'bg-purple-50 text-purple-700',
                                'etudiant' => 'bg-blue-50 text-blue-700',
                                'jeune professionnel' => 'bg-emerald-50 text-emerald-700',
                                'chomeur' => 'bg-amber-50 text-amber-700',
                                'professionel experimenter', 'professionnel expérimenté' => 'bg-[#8C4B31]/10 text-[#8C4B31]',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#26295C] text-xs font-bold text-white">
                                        {{ strtoupper(substr($client->prenom ?? 'C', 0, 1) . substr($client->nom ?? '', 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-bold text-gray-800">
                                            {{ $client->prenom }} {{ $client->nom }}
                                        </p>

                                        <p class="truncate text-xs text-gray-400">
                                            {{ $client->email }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm text-gray-600">
                                    {{ $client->domaine ?: '—' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-[11px] font-bold {{ $occupationClasses }}">
                                    {{ $client->occupation ?: 'Non défini' }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                @if($client->formations && $client->formations->count())
                                    <div class="max-w-[180px]">
                                        <p class="truncate text-sm font-semibold text-gray-700">
                                            {{ $client->formations->first()->intitule }}
                                        </p>

                                        @if($client->formations->count() > 1)
                                            <span class="text-xs text-gray-400">
                                                +{{ $client->formations->count() - 1 }} autre(s)
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400">
                                        Aucune
                                    </span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-xs text-gray-500">
                                {{ $client->created_at?->format('d/m/Y') ?? '—' }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="px-5 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-users mb-3 text-3xl text-gray-300"></i>
                                    <p class="text-sm font-semibold text-gray-500">
                                        Aucune inscription récente
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>


    {{-- =====================================================
        RECENT ANNOUNCEMENTS
    ====================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-5 sm:px-6">

            <div>
                <h2 class="text-lg font-extrabold text-[#26295C]">
                    Dernières annonces
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Les publications les plus récentes
                </p>
            </div>

            <a
                href=""
                class="inline-flex items-center gap-1 text-sm font-bold text-[#8C4B31] hover:text-[#743D29]"
            >
                Voir tout
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>

        </div>

        <div class="divide-y divide-gray-100">

            @forelse($recentAnnonces as $annonce)

                <article class="p-5 transition hover:bg-gray-50 sm:p-6">

                    <div class="flex gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#8C4B31]/10 text-[#8C4B31]">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>

                        <div class="min-w-0 flex-1">

                            <div class="mb-2 flex flex-wrap items-center gap-2">

                                <span class="inline-flex rounded-full bg-[#26295C]/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-[#26295C]">
                                    {{ $annonce->categorie ?: 'Général' }}
                                </span>

                                <span class="text-xs text-gray-400">
                                    {{ $annonce->created_at?->diffForHumans() }}
                                </span>

                            </div>

                            <h3 class="line-clamp-1 text-sm font-extrabold text-gray-800">
                                {{ $annonce->titre }}
                            </h3>

                            <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-500">
                                {{ $annonce->description }}
                            </p>

                        </div>

                    </div>

                </article>

            @empty

                <div class="px-5 py-12 text-center">
                    <i class="fa-solid fa-bullhorn mb-3 text-3xl text-gray-300"></i>
                    <p class="text-sm font-semibold text-gray-500">
                        Aucune annonce publiée
                    </p>
                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =========================================================
    SECONDARY SECTION
========================================================== --}}
<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    {{-- =====================================================
        RECENT FORMATIONS
    ====================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm xl:col-span-2">

        <div class="flex flex-col gap-3 border-b border-gray-200 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

            <div>
                <h2 class="text-lg font-extrabold text-[#26295C]">
                    Formations récentes
                </h2>

                <p class="mt-1 text-xs text-gray-500">
                    Aperçu des formations disponibles
                </p>
            </div>

            <a
                href=""
                class="inline-flex items-center gap-1 text-sm font-bold text-[#8C4B31] hover:text-[#743D29]"
            >
                Toutes les formations
                <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>

        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] text-left">

                <thead class="bg-gray-50 text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-5 py-3 font-bold">Formation</th>
                        <th class="px-5 py-3 font-bold">Prix</th>
                        <th class="px-5 py-3 font-bold">Durée</th>
                        <th class="px-5 py-3 font-bold">Inscrits</th>
                        <th class="px-5 py-3 font-bold">Modules</th>
                        <th class="px-5 py-3 font-bold">Statut</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse($recentFormations as $formation)

                        <tr class="transition hover:bg-gray-50">

                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-[#26295C]/10 text-[#26295C]">
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>

                                    <div class="min-w-0">
                                        <p class="max-w-[230px] truncate text-sm font-bold text-gray-800">
                                            {{ $formation->intitule }}
                                        </p>
                                    </div>

                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm font-semibold text-gray-700">
                                {{ number_format($formation->prix ?? 0, 0, ',', ' ') }} RWF
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-gray-500">
                                {{ $formation->duree ?: '—' }}
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 text-sm font-bold text-gray-700">
                                    <i class="fa-solid fa-users text-xs text-[#8C4B31]"></i>
                                    {{ $formation->clients_count ?? 0 }}
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-600">
                                    <i class="fa-solid fa-layer-group text-xs text-gray-400"></i>
                                    {{ $formation->modules_count ?? 0 }}
                                </span>
                            </td>

                            <td class="px-5 py-4">

                                @if($formation->disponible)

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-bold text-emerald-700">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Disponible
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-[11px] font-bold text-gray-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                        Indisponible
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center">
                                <i class="fa-solid fa-graduation-cap mb-3 text-3xl text-gray-300"></i>
                                <p class="text-sm font-semibold text-gray-500">
                                    Aucune formation récente
                                </p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

    </div>


    {{-- =====================================================
        OCCUPATION DISTRIBUTION
    ====================================================== --}}
    <div
        class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm sm:p-6"
        x-data
    >

        <div class="mb-6">
            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-[#26295C]/10 text-[#26295C]">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>

                <div>
                    <h2 class="text-lg font-extrabold text-[#26295C]">
                        Profils des participants
                    </h2>

                    <p class="mt-1 text-xs text-gray-500">
                        Répartition par occupation
                    </p>
                </div>

            </div>
        </div>

        @php
            $occupationTotal = collect($occupations)->sum();
        @endphp

        <div class="space-y-5">

            @forelse($occupations as $occupation => $count)

                @php
                    $percentage = $occupationTotal > 0
                        ? round(($count / $occupationTotal) * 100)
                        : 0;

                    $barClass = match ($occupation) {
                        'Eleve' => 'bg-purple-500',
                        'Etudiant' => 'bg-blue-500',
                        'Jeune Professionnel' => 'bg-emerald-500',
                        'Chomeur' => 'bg-amber-500',
                        'Professionel experimenter' => 'bg-[#8C4B31]',
                        default => 'bg-[#26295C]',
                    };
                @endphp

                <div>

                    <div class="mb-2 flex items-center justify-between gap-3">

                        <span class="truncate text-sm font-semibold text-gray-700">
                            {{ $occupation }}
                        </span>

                        <div class="flex shrink-0 items-center gap-2">
                            <span class="text-xs font-bold text-gray-500">
                                {{ $count }}
                            </span>

                            <span class="w-10 text-right text-xs font-bold text-[#26295C]">
                                {{ $percentage }}%
                            </span>
                        </div>

                    </div>

                    <div class="h-2 overflow-hidden rounded-full bg-gray-100">
                        <div
                            class="h-full rounded-full transition-all duration-500 {{ $barClass }}"
                            style="width: {{ $percentage }}%"
                        ></div>
                    </div>

                </div>

            @empty

                <div class="py-10 text-center">
                    <i class="fa-solid fa-chart-pie mb-3 text-3xl text-gray-300"></i>

                    <p class="text-sm font-semibold text-gray-500">
                        Aucune donnée disponible
                    </p>
                </div>

            @endforelse

        </div>

        @if($occupationTotal > 0)

            <div class="mt-7 rounded-xl bg-gray-50 p-4">
                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-users text-[#8C4B31]"></i>

                        <span class="text-sm font-bold text-gray-700">
                            Total participants
                        </span>
                    </div>

                    <span class="text-lg font-extrabold text-[#26295C]">
                        {{ $occupationTotal }}
                    </span>

                </div>
            </div>

        @endif

    </div>

</div>


</div>



</x-adminLayout>