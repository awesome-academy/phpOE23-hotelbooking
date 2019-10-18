<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ trans('home.name') }} {{ trans('home.parent_page_a') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/toastr/toastr.min.css') }}">
    <link href="{{ asset('bower_components/adminlte3/googleapis.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/toastr/toastr.min.css') }}">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home_index') }}" class="nav-link"> {{ trans('home.parent_page_h') }} </a>
                </li>
            </ul>
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">  </span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i>
                            <span class="float-right text-muted text-sm"></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">{{ trans('home.see_all_noti') }}</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header"><b> {{ trans('home.hello') }}, {{ Auth::user()->name }} </b></span>
                        <span class="dropdown-header"><b> {{ trans('home.basic_info') }} </b></span>
                        <span class="dropdown-header"> {{ Auth::user()->email }} </span>
                        <span class="dropdown-header"> {{ Auth::user()->country->phone_code }} {{ Auth::user()->phone }} </span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-user"></i>&nbsp;&nbsp; {{ trans('home.page_profile') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item btn btn-danger" type="button" data-toggle="modal" data-target="#logout-modal">
                            <i class="fa fa-lock"></i>&nbsp;&nbsp; {{ trans('auth_forms.submit_o') }}
                        </button>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fab fa-acquisitions-incorporated"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ( $langs as $lang )
                            <a class="nav-link" href="{{ route('admin_change_lang', ['locale' => $lang->lang_code]) }}"> {{ $lang->name }} ( {{ $lang->lang_code }} ) </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                    <i class="fas fa-th-large"></i></a>
                </li>
            </ul>
        </nav>
        <div class="modal fade" id="logout-modal">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title"> {{ trans('auth_forms.sure') }} </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p> {{ trans('auth_forms.request_logout') }} </p>
                    </div>
                    <form method="post" action="{{ route('logout') }}">
                        {{ csrf_field() }}
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                {{ trans('auth_forms.close') }}
                            </button>
                            <button type="submit" class="btn btn-outline-light">
                                {{ trans('auth_forms.submit_o') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('bower_components/adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light"> {{ trans('home.name') }} </span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('bower_components/adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin_users_index') }}" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    {{ trans('admin.users_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-star"></i>
                                <p>
                                    {{ trans('admin.roles_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-indent"></i>
                                <p>
                                    {{ trans('admin.permissions_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-flag"></i>
                                <p>
                                    {{ trans('admin.countries_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-road"></i>
                                <p>
                                    {{ trans('admin.cities_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="{{ route('admin_hotels_index') }}" class="nav-link">
                                <i class="nav-icon fas fa-building"></i>
                                <p>
                                    {{ trans('admin.hotels_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bed"></i>
                                <p>
                                    {{ trans('admin.room_types_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bookmark"></i>
                                <p>
                                    {{ trans('admin.booking_cards_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-square"></i>
                                <p>
                                    {{ trans('admin.currencies_title') }}
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
        	</div>
        </aside>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ trans('home.name') }} {{ trans('home.parent_page_a') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">{{ trans('home.parent_page_a') }}</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5></h5>
                <p></p>
            </div>
        </aside>
        <footer class="main-footer">
        </footer>
    </div>
    <script src="{{ asset('bower_components/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/dist/js/adminlte.min.js') }}"></script>
    @yield('js')
</body>
</html>
