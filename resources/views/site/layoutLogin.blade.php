<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="light" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="imagens/icone_logo.png" type="image/x-icon">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary h-100">
    <main class="w-100 m-auto" style="max-width: 15rem; padding:1rem;">
        @yield('form')
        @yield('botaoAux')
        {{-- <p class="text-body-secondary mt-3 mb-3">© 2023</p> --}}
    </main>
</body>
</html>