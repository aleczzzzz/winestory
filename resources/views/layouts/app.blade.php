<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    WS
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    winestory
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{asset('assets/img/faces/avatar.jpg')}}" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                {{Auth::user()->name}}
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="{{route('users.profile')}}">
                                        <span class="sidebar-mini"> MP </span>
                                        <span class="sidebar-normal"> My Profile </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="{{Request::is('dashboard') ? 'active' : null}}">
                        <a href="{{url('dashboard')}}">
                            <i class="material-icons">dashboard</i>
                            <p> Dashboard </p>
                        </a>
                    </li>
                    <li class="{{Request::is('dashboard/products*') ? 'active' : null}}">
                        <a data-toggle="collapse" href="#pagesExamples" aria-expanded="{{Request::is('dashboard/products*') ? 'true' : 'false'}}">
                            <i class="material-icons">image</i>
                            <p> Products
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse {{Request::is('dashboard/products*') ? 'in' : null}}" aria-expanded="{{Request::is('dashboard/products*') ? 'true' : 'false'}}" id="pagesExamples">
                            <ul class="nav">
                                <li class="{{Request::is('dashboard/products') ? 'active' : null}}">
                                    <a href="{{route('dashboard.products.index')}}">
                                        <span class="sidebar-mini"> P </span>
                                        <span class="sidebar-normal"> Show Products </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"> Dashboard </a>
                    </div>
                </div>
            </nav>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div> 
            
    <!-- Scripts -->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}" ></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('assets/js/material.min.js') }}" ></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/js/jquery.tagsinput.js') }}" ></script>
    <script src="{{ asset('assets/js/material-dashboard.js') }}" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    @stack('scripts')
    <script>
        $(function() {
            $('.delete').click(function(event){
                event.preventDefault();
                var x = false;
                $.confirm({
                    title: 'Are you sure?',
                    content: 'Are you sure you want to delete this product?',
                    buttons: {
                        confirm: {
                                btnClass: 'btn-rose',
                                action: function () {
                                    $('.delete-form').submit();
                                }
                        },
                        cancel: function () {
                            
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
