<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    
  @yield('opcoesUsuario')

  <div id="slide-out" class="sidenav">
    <ul>
        <!-- Mova as opções do menu para o menu lateral -->
        @yield('opcoesMenu')
    </ul>
  </div>

  <nav class="orange">
    <div class="nav-wrapper container">
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        <a href="#" class="brand-logo center" id="site-title" style="text-decoration:none;">Duociclo</a>

        <!-- Mantenha as opções do menu aqui, elas também estarão no menu lateral -->
        <ul id="nav-mobile" class="left hide-on-med-and-down">
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

        $('.sidenav').sidenav();

        $('.sidenav-trigger').on('click', function(){
            $('.sidenav').sidenav('open');
        });
        
        // Verifique se a mensagem de sucesso está definida
        var sucessoMessage = "{{ session('sucessoHome') }}";
        
        if (sucessoMessage) {
            M.toast({ html: sucessoMessage, classes: 'green' });
        }
      });

      document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems, {
              edge: 'left' // Define o lado do menu (esquerda)
          });
      });

      document.addEventListener('DOMContentLoaded', function() {
        var siteTitle = document.getElementById('site-title');
        var menuOptions = document.querySelector('.nav-wrapper ul.left');
        
        // Verifica e oculta o menu ao carregar a página
        hideMenuOptionsIfNeeded(siteTitle, menuOptions);
        
        // Verifica e oculta o menu ao redimensionar a janela
        window.addEventListener('resize', function() {
          hideMenuOptionsIfNeeded(siteTitle, menuOptions);
        });
        
        // Função para ocultar as opções do menu, se necessário
        function hideMenuOptionsIfNeeded(title, options) {
          var titleRect = title.getBoundingClientRect();
          var optionsRect = options.getBoundingClientRect();
          if (titleRect.bottom < optionsRect.top) {
            options.style.display = 'none';
          } else {
            options.style.display = 'block';
          }
        }
      });
  </script>
</body>
</html>