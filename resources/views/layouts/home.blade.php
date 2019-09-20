<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ trans('home.name') }} {{ trans('home.parent_page_h') }} | @yield('title')</title>
	<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/dist/css/adminlte.min.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
					<a href="index3.html" class="nav-link">{{ trans('home.parent_page_h') }}</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-header"> {{ trans('home.noti_num', ['number' => '0']) }} </span>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<span class="float-right text-muted text-sm"></span>
						</a>
						<div class="dropdown-divider"></div>
					 	<a href="#" class="dropdown-item dropdown-footer">{{ trans('home.see_all_noti') }}</a>
					</div>
				</li>
				<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
					<i class="fas fa-th-large"></i></a>
				</li>
			</ul>
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="#" class="brand-link">
				<img src="{{ asset('bower_components/adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
				<span class="brand-text font-weight-light">{{ trans('home.name') }}</span>
			</a>
			<div class="sidebar">
				@auth
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="{{ asset('bower_components/adminlte3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">{{ Auth::user()->name }}</a>
					</div>
				</div>
				@else
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<a href="{{ route('login') }}" class="btn-block btn-lg btn-secondary"> {{ trans('home.already_signup') }} </a>
				</div>
				@endauth
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item has-treeview menu-open">
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
									<a href="#" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
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
							<h1 class="m-0 text-dark">{{ trans('home.name') }} {{ trans('home.parent_page_h') }}</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">{{ trans('home.parent_page_h') }}</a></li>
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
				<h5>
					@auth
						{{ trans('home.hello') }}, {{ Auth::user()->name }}
					@else
						{{ trans('home.nothing_to_show') }}
					@endauth
				</h5>
				@auth
					<p>
						{{ trans('home.basic_info') }}  <a href="#"><i class="fa fa-edit"></i></a> :
					</p>
					<p>
						{{ Auth::user()->email }}
					</p>
					<p>
						{{ Auth::user()->country->phone_code }} {{ Auth::user()->phone }}
					</p>
					<form method="post" action="{{ route('logout') }}">
						{{ csrf_field() }}
						<div class="btn-group">
							<input type="submit" class="btn btn-outline-danger" value="Logout">
		                </div>
		            </form>
				@else
					{{ trans('home.login_to_see_more') }}!
					<div class="btn-group">
						<a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-key"></i> {{ trans('auth_forms.submit_l') }} </a>
						<a href="{{ route('register') }}" class="btn btn-default"><i class="fa fa-user"></i> {{ trans('auth_forms.submit_r') }} </a>
					</div>
				@endauth
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
