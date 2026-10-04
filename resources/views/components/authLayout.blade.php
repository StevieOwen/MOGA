<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Centre de Formation MOGA Initiative</title>
    <meta
        name="description"
        content="Centre de Formation MOGA Initiative — Former la jeunesse, Construire le pays."
    >

    <!-- =========================================================
         TAILWIND CSS
         Configuration prévue pour un build Tailwind local.
         Les classes utilisées dans cette page seront compilées
         dans css/style.css.
    ========================================================== -->
    <link rel="stylesheet" href="css/style.css">
    @vite('resources/css/app.css')

    <!-- =========================================================
         FONT AWESOME
    ========================================================== -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >
</head>
<body class="bg-slate-50 text-slate-900 antialiased">


    {{$slot}}

</body>
</html>