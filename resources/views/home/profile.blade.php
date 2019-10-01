@extends('layouts.home')

@section('title')
{{ trans('home.page_profile') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="" alt="{{ trans('profile.alt') }}">
                    </div>
                    <h3 class="profile-username text-center"> {{ Auth::user()->name }} </h3>
                    <p class="text-muted text-center">
                        {{ Auth::user()->country->name }} 
                    </p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>{{ trans('profile.order') }}</b> <a class="float-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('profile.done') }}</b> <a class="float-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('profile.pending') }}</b> <a class="float-right"></a>
                        </li>
                    </ul>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#change-pic-modal"><b>{{ trans('profile.change_pic') }}</b></button>
                </div>
            </div>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ trans('profile.about') }}</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i>{{ trans('auth_forms.email') }}</strong>
                    <p class="text-muted">
                        {{ Auth::user()->email }}    
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i>{{ trans('auth_forms.phone') }}</strong>
                    <p class="text-muted">
                        {{ Auth::user()->country->phone_code }} {{ Auth::user()->phone }}
                    </p>
                    <hr>
                </div>
            </div>
		</div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#history" data-toggle="tab">{{ trans('profile.history') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#edit" data-toggle="tab">{{ trans('profile.edit') }}</a></li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="history">
                            
                        </div>

                        <div class="tab-pane" id="edit">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change-pic-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> {{ trans('profile.change_pic') }} </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> {{ trans('profile.choose_pic') }} </p>
                </div>
                <form method="post" action="#">
                    {{ csrf_field() }}
                    <input class="form-control" type="file" name="pic" accept="image/*" enctype="multipart/form-data">
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            {{ trans('profile.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{ trans('profile.submit_pic') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
