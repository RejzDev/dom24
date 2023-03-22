<!DOCTYPE html>
<html lang="en" style="height: auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') Admin-panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">

   @yield('css')

</head>
<body class="sidebar-mini layout-fixed" style="height: auto; min-height: 100%">
<div class="wrapper col-sm-12" style="height: auto; min-height: 100%">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('image/logo.svg')}}" alt="MyDom24" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link">Панель администратора</span>
            </li>


        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            <li class=" nav-item dropdown user user-menu">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user-circle text-purple"></i>
                    <span class="hidden-xs">{{Auth::guard('admin')->user()->username}}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header bg-light">
                       <img src="dist/img/user2-160x160.jpg" class="img-circle">

                        <p>{{Auth::guard('admin')->user()->username}} (Директор)</p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="float-left">
                            <a class="btn btn-default btn-flat" href="">Профиль</a>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-default btn-flat" href="{{route('admin.logout')}}" data-method="post">Выход</a>
                        </div>
                    </li>
                </ul>
            </li>

        </ul>

        <!-- Sidebar user panel (optional) -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-white elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link logo-switch">
            <img src="{{asset('image/logo-mini.svg')}}" alt="MyDom24" class="brand-image-xl logo-xs">
            <img src="{{asset('image/logo.svg')}}" alt="MyDom24" class="brand-image-xs logo-xl" style=" left: 60px ">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">



            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-chart-area"></i>
                            <p>
                                Статистика
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-dollar-sign"></i>
                            <p>
                                Каса
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/invoice" class="nav-link">
                            <i class="nav-icon fa fa-file"></i>
                            <p>
                                Квитанции на оплату
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/personalAccount" class="nav-link">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p>
                                Лицевые счета
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('adminApartamentsIndex')}}" class="nav-link">
                            <i class="nav-icon fa fa-key"></i>
                            <p>
                                Квартиры
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('userIndex')}}" class="nav-link">
                            <i class="nav-icon fa fa-user-friends"></i>
                            <p>
                                Владельцы квартир
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('adminHouseIndex')}}" class="nav-link">
                            <i class="nav-icon fa fa-house-user"></i>
                            <p>
                                Дома
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-envelope"></i>
                            <p>
                                Сообщения
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>
                                Заявки вызова мастера
                            </p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-tachometer-alt"></i>
                            <p>
                                Показания счетчиков
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-desktop"></i>
                            <p>
                                 Управление сайтом
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/admin-panel" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Главная страница</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/admin-panel/about" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>О нас</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('adminServicesPage')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Услуги</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('websiteContact')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Контакты</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Настройки системы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('serviceEdit')}}" class="nav-link">
                                    <i class="fa fa-briefcase nav-icon"></i>
                                    <p>Услуги</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('tariff.index')}}" class="nav-link">
                                    <i class="fa fa-money-check nav-icon"></i>
                                    <p>Тарифы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.roleIndex')}}" class="nav-link">
                                    <i class="fa fa-user nav-icon"></i>
                                    <p>Роли</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.userAdmin-index')}}" class="nav-link">
                                    <i class="fa fa-user-plus nav-icon"></i>
                                    <p>Пользователи</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-credit-card nav-icon"></i>
                                    <p>Платежные реквизиты</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fa fa-list nav-icon"></i>
                                    <p>Статьи платежей</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>


            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="card-title">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->


                @yield('content')


            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            </div>

            </section>

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        Разработано <a href="https://avada-media.ua/">AVADA-MEDIA</a>. На базе системы управления <a href="https://avada-media.ua/moydom24/">"МойДом24"</a>.
        Документация API доступна <a href="/doc">по ссылке</a>.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
@yield('js')
</body>
</html>
