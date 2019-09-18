<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>ABCDEF Home | @yield('title')</title>
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
					<a href="index3.html" class="nav-link">Home</a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Contact</a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-comments"></i>
						<span class="badge badge-danger navbar-badge">3</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a href="#" class="dropdown-item">
							<div class="media">
								<img src="{{ asset('bower_components/adminlte3/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
								<div class="media-body">
								    <h3 class="dropdown-item-title">
								    	Brad Diesel
								    	<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
								    </h3>
								    <p class="text-sm">Call me whenever you can...</p>
								    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<div class="media">
								<img src="{{ asset('bower_components/adminlte3/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
								<div class="media-body">
							    <h3 class="dropdown-item-title">
							    	John Pierce
							    	<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
							    </h3>
							    <p class="text-sm">I got your message bro</p>
							    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
								</div>
							</div>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
						<div class="media">
							<img src="{{ asset('bower_components/adminlte3/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
							<div class="media-body">
							    <h3 class="dropdown-item-title">
							    	Nora Silvester
							    	<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
							    </h3>
							    <p class="text-sm">The subject goes here</p>
							    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
							</div>
						</div>
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="far fa-bell"></i>
						<span class="badge badge-warning navbar-badge">15</span>
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<span class="dropdown-header">15 Notifications</span>
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
				<li class="nav-item">
				<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
					<i class="fas fa-th-large"></i></a>
				</li>
			</ul>
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="#" class="brand-link">
				<img src="{{ asset('bower_components/adminlte3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
				<span class="brand-text font-weight-light">ABCDEF</span>
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
					<a href="{{ route('login') }}" class="btn-block btn-lg btn-secondary"> Already signed up? </a>
				</div>
				@endauth
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item has-treeview menu-open">
							<a href="#" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Starter Pages
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link active">
										<i class="far fa-circle nav-icon"></i>
										<p>Active Page</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="far fa-circle nav-icon"></i>
										<p>Inactive Page</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-th"></i>
								<p>
								    Simple Link
								    <span class="right badge badge-danger">New</span>
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
							<h1 class="m-0 text-dark">ABCDEF Home</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
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
						Hello, {{ Auth::user()->name }}
					@else
						Nothing to show
					@endauth
				</h5>
				@auth
					<p>
						Basic info  <a href="#"><i class="fa fa-edit"></i></a> :
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
					Login to see more contents!
					<div class="btn-group">
						<a href="{{ route('login') }}" class="btn btn-primary"><i class="fa fa-key"></i> Login now</a>
						<a href="{{ route('register') }}" class="btn btn-default"><i class="fa fa-user"></i> Register</a>
					</div>
				@endauth
			</div>
		</aside>
		<footer class="main-footer">
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
		</footer>
	</div>
	<script src="{{ asset('bower_components/adminlte3/plugins/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('bower_components/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('bower_components/adminlte3/dist/js/adminlte.min.js') }}"></script>
	@yield('js')
</body>
</html>