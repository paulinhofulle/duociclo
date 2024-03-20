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
            position: relative;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
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
            margin-top: 50px;
        }
        .logo {
            max-width: 25rem;
            margin-top: -8rem;
        }
        .card {
            margin-bottom: 20px;
            border-radius: 20px;
            height: 0;
            padding-bottom: 100%;
            cursor: pointer;
            overflow: hidden;
        }
        .card-img-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 70%;
            object-fit: cover;
        }
        .card-body {
            padding: 10px;
        }
        .card-title {
            font-size: 17px;
            font-weight: 500;
            margin-top: 5px;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <video autoplay loop muted playsinline>
        <source src="img/ceu_estrelado2.mp4" type="video/mp4">
    </video>
    <main>
        <img src="img/logo_fulle.png" alt="Logo" class="logo">
        <div class="container">
            <div class="row row-cols-2 row-cols-md-2 g-4">
                <div class="col">
                    <a href="{{ route('duociclo/login') }}">
                    <div class="card">
                        <img src="imagens/duociclo_logo.png" class="card-img-top" alt="Imagem 1">
                        <div class="card-body">
                            <p class="card-title">Duociclo</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <img src="imagens/rebrecho_logo.png" class="card-img-top" alt="Imagem 2">
                        <div class="card-body">
                            <p class="card-title">Rebrechó</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
