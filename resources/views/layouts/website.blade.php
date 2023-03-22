<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('seoDescription')">
    <meta name="keywords" content="@yield('seoKeywords')">
    <title>@yield('title')</title>


    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">

    @yield('css')

</head>
<body>

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                    <a class="navbar-brand navbar" href="#">
                        <img src="{{asset('image/logo.svg')}}" alt="" width="auto" height="40px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('websiteMain')}}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('websiteAbout')}}">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('websiteServices')}}">Услуги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Условия приобретения</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('websiteContacts')}}">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.login')}}"><i class="fa fa-sign-in"></i>Вход</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>


    @yield('content')


    <footer class="footer  mt-auto py-1  bg-dark">
        <div class="container">
            <div class="col-xs-12 text-center">
                <p class="text-light">Разработано <a href="https://avada-media.ua/">AVADA-MEDIA</a>. На базе системы управления <a href="https://avada-media.ua/moydom24/">"МойДом24"</a></p>
            </div>
        </div>
    </footer>





<script src="{{ asset('js/bootstrap.js') }}" defer></script>
@yield('js')
</body>
</html>
