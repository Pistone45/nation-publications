<?php
          $email= Auth::user()->email;
         
          // Removing Spaces
          $email = trim($email);
         
          // Make all Lower Case
          $email = strtolower($email);

          // Generating Hash
          $email_hash = md5($email);

        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>{{ config('app.name', 'Home') }} | @yield('title')</title>

    <!-- Chart Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.esm.js" integrity="sha512-ed7vUABA1bHD/KxuT8QuoEujQh54YD1K9JqVQznmCysUHCqws1onhPmp2BeZmMBO8Z7Ej3jQhZCnZqbAbbXGng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.esm.min.js" integrity="sha512-YddsjqDwjknf6zcj3q5HNwBjL1PNAK+il95CpN5Y/Vlugdc/laK6vdnQt1aGTj8/xwvW3Sss3yZAnsltzt6lUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.js" integrity="sha512-/MqITtqQfmjLnDtBC8yxrsERbn3dvqyxtc1B/3x57xp+J3srVBcgyr9VXgDj8BYScxSJ9MauIMY7F9Fr2TJHkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/helpers.esm.js" integrity="sha512-J4vecZHtIp+6W2R49ZiYw/4uoynlgkzXHRd8nXMqbxP8aIwt3iQDTn1HV83PLo7vJ/tSYTG7Lki1rry/4GmZpg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/helpers.esm.min.js" integrity="sha512-gpjTYwezklFWasKVajjiPstSIESEHV3p0QK5/blAsx4xSU7wK2MAqU5klhZ+xIoZZnf8qHTgVUAI5uOKo70lLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Fontfaces CSS-->
    <link href="{{ asset('dashboard/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/fontawesome-6/css/all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('dashboard/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('dashboard/vendor/vector-map/jqvmap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('dashboard/css/theme.css') }}" rel="stylesheet" media="all">

</head>
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <div align="center">
                                    <img class="mx-auto d-block" src="{{ asset('dashboard/images/icon/logo-white.png') }}" alt="CoolAdmin" />
                                    </div>
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text" placeholder="Search for datas &amp; reports..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
           
                                <div class="header-button-item mr-0 js-sidebar-btn">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                                <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ asset('profile') }}">
                                                <i class="zmdi zmdi-account"></i>Account</a>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <a href="{{ asset('subscriptions/view') }}">
                                                <i class="zmdi zmdi-money-box"></i>Billing</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo" align="center">
                <a href="/home">
                    <img width="60" height="60" src="{{ asset('dashboard/images/np-logo.jpg') }}" alt="Logo" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="https://www.gravatar.com/avatar/<?php echo $email_hash?>?s=500" alt="Profile Picture" />
                    </div>
                    <h4 class="name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">
        <h6 style="color: blue;">Logout</h6>
    </button>
</form>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">

                        <li class="has-sub {{ Request::path() === 'home' ? 'active' : '' }}">
                            <a href="{{ asset('home') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>

                        @if(Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Admin')

                        <li class="has-sub {{ Request::path() === 'subscriptions/view' ? 'active' : '' }}">
                            <a class="js-arrow" href="#">
                                <i class="fa-solid fa-cart-plus"></i>Subscribers
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="{{ Request::path() === 'subscriptions/subscribers' ? 'active' : '' }}">
                                    <a href="{{ asset('subscribers') }}">
                                        <i class="fa-solid fa-circle-plus"></i>View all</a>
                                </li>

                                <li class="{{ Request::path() === 'subscriptions/regions' ? 'active' : '' }}">
                                    <a href="{{ asset('subscriptions/regions') }}">
                                        <i class="fa-solid fa-circle-plus"></i>View by Region</a>
                                </li>

                                <li class="{{ Request::path() === 'subscribers/history' ? 'active' : '' }}">
                                    <a href="{{ asset('subscribers/history') }}">
                                        <i class="fa-solid fa-eye"></i>Subscription History</a>
                                </li>

                            </ul>
                        </li>

                        <li class="has-sub {{ Request::path() === 'users' ? 'active' : '' }}">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-users"></i>Users
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="{{ Request::path() === 'users' ? 'active' : '' }}">
                                    <a href="{{ asset('users') }}">
                                        <i class="fas fa-user"></i>Users</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="roles">
                                <i class="fa-solid fa-user-tag"></i>Roles</a>
                        </li>

                        @elseif(Auth::user()->role->name == 'Customer' || Auth::user()->role->name == 'customer')

                        <li class="has-sub {{ Request::path() === 'subscriptions/view' ? 'active' : '' }}">
                            <a class="js-arrow" href="#">
                                <i class="fa-solid fa-cart-plus"></i>Subscriptions
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li class="{{ Request::path() === 'subscriptions/view' ? 'active' : '' }}">
                                    <a href="{{ asset('subscriptions') }}">
                                        <i class="fa-solid fa-circle-plus"></i>Subscribe</a>
                                </li>

                                <li class="{{ Request::path() === 'subscriptions/view' ? 'active' : '' }}">
                                    <a href="{{ asset('subscriptions/view') }}">
                                        <i class="fa-solid fa-eye"></i>View Subscriptions</a>
                                </li>

                                <li class="{{ Request::path() === 'subscriptions/publications' ? 'active' : '' }}">
                                    <a href="{{ asset('subscriptions/publications') }}">
                                        <i class="fa-solid fa-newspaper"></i> View Newspaper</a>
                                </li>

                                <li class="{{ Request::path() === 'subscriptions/history' ? 'active' : '' }}">
                                    <a href="{{ asset('subscriptions/history') }}">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Subscription History</a>
                                </li>

                            </ul>
                        </li>

                        @endif

                        <li class="{{ Request::path() === 'profile' ? 'active' : '' }}">
                            <a href="{{ asset('profile') }}">
                                <i class="fas fa-user"></i>Profile</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

@yield('content')
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('dashboard/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('dashboard/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('dashboard/vendor/slick/slick.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/counter-up/jquery.counterup.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/select2/select2.min.js') }}">
    </script>
    <script src="{{ asset('dashboard/vendor/vector-map/jquery.vmap.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/vector-map/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/vector-map/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/vector-map/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('dashboard/js/moment.js') }}"></script>
    <!-- Main JS-->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>

</html>
<!-- end document-->
