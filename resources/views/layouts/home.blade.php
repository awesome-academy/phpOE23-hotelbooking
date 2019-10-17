<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('home.name') }} {{ trans('home.parent_page_h') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/toastr/toastr.min.css') }}">
    <link href="{{ asset('bower_components/adminlte3/googleapis.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="{{ asset('bower_components/adminlte3/custom/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('bower_components/adminlte3/custom/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('bower_components/adminlte3/custom/css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('bower_components/adminlte3/custom/css/custom.css') }}" />
    @yield('css')

</head>

<body>
    <header id="header">
        <div id="nav">
            <div id="nav-top">
                <div class="container">
                    <div class="nav-logo">
                        <a href="{{ route('home_index') }}" class="logo"><img src="{{ asset('bower_components/adminlte3/mylogo.png') }}" alt=""></a>
                    </div>
                    <div class="nav-btns">
                        @guest
                            <a class="btn btn-default" href="{{ route('login') }}" role="button"><i class="fa fa-key"></i></a>
                            @if (Route::has('register'))
                                <a class="btn btn-default" href="{{ route('register') }}" role="button"><i class="fa fa-user-plus"></i></a>
                            @endif
                        @else
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-user"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div>
                                    <a class="dropdown-item btn btn-default" href="{{ route('home_profile') }}">
                                        <i class="fa fa-folder-open"></i>
                                        &nbsp;&nbsp;{{ trans('home.page_profile') }}
                                    </a>
                                </div>

                                <div>
                                    <button class="dropdown-item btn btn-danger" data-toggle="modal" data-target="#logout-modal">
                                        <i class="fa fa-lock"></i>
                                        &nbsp;&nbsp;{{ trans('auth_forms.submit_o') }}
                                    </button>
                                </div>
                            </div>
                        @endguest

                        <button class="aside-btn"><i class="fa fa-language"></i></button>
                        <button class="search-btn"><i class="fa fa-search"></i></button>

                        <div id="nav-search">
                            <form method="post" action="#">
                                @csrf
                                <input class="input" name="search">
                            </form>
                            <button class="nav-close search-close">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="nav-aside">
                <ul class="nav-aside-menu">
                    @foreach ( $langs as $lang )
                        <li>
                            <a class="nav-link" href="{{ route('home_change_lang', ['locale' => $lang->lang_code]) }}"> {{ $lang->name }} ( {{ $lang->lang_code }} ) </a>
                        </li>
                    @endforeach
                </ul>
                <button class="nav-close nav-aside-close"><span></span></button>
            </div>
        </div>
    </header>

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

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="container">
            <div class="footer-bottom row">
              
                <div class="col-md-6 col-md-push-3 text-center">
                    <div class="footer-copyright">
                        {{ trans('home.name') }} &copy;
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('bower_components/adminlte3/custom/js/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/custom/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/custom/js/main.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/custom/js/custom.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('bower_components/adminlte3/plugins/toastr/toastr.min.js') }}"></script>
    @yield('js')
</body>

</html>