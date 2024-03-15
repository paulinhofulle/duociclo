<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="light" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fulle Sistemas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" href="img/fs_logo.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        video {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }
        main {
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .logo {
            max-width: 25rem; /* ajuste conforme necessário */
            margin-top: -25rem; /* ajuste conforme necessário */
        }
    </style>
</head>
<body>
    <video autoplay loop muted playsinline>
        <source src="img/ceu_estrelado2.mp4" type="video/mp4">
    </video>
    <main>
        <img src="img/logo_fulle.png" alt="Logo" class="logo">
        <!-- Seu conteúdo aqui -->
    </main>
</body>
</html>
