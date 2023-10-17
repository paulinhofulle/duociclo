<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom CSS-->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    
  @yield('opcoesUsuario')

  <nav class="orange">
      <div class="nav-wrapper container">
        <a href="#" class="brand-logo center" style="text-decoration:none;">Duociclo</a>
        <ul id="nav-mobile" class="left">
          @yield('opcoesMenu')
        </ul>

        <ul id="nav-mobile2" class="right">
          @if (auth()->check())
            <li><a href="#" class="dropdown-trigger" data-target="dropdown1">Olá {{ explode(' ', auth()->user()->usunome)[0] }}! <i class="material-icons right">expand_more</i></a></li>
          @endif
        </ul>
      </div>
  </nav>

  @yield('conteudo')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
      var elems = document.querySelectorAll('.dropdown-trigger');
      var instances = M.Dropdown.init(elems, {
        coverTrigger: false,
        constrainWidth: false
      });

      $(document).ready(function() {
        // Verifique se a mensagem de sucesso está definida
        var sucessoMessage = "{{ session('sucessoHome') }}";
        
        if (sucessoMessage) {
            M.toast({ html: sucessoMessage, classes: 'green' });
        }
      });
  </script>
</body>
</html>