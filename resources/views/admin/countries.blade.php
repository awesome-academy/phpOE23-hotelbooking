@extends('layouts.admin')

@section('title')
{{ trans('admin.countries_title') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')

@if ( $errors->any() )
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            <strong> {{ $error }} </strong>
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <strong> {{ session('success') }} </strong>
    </div>
@endif

@if (session('message'))
    <div class="alert alert-warning" role="alert">
        <strong> {{ session('message') }} </strong>
    </div>
@endif

<div class="card-body">
    <div class="row">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#new-country">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ trans('admin.create') }} 
        </button>
    </div>
    <br>
    <table id="table1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> {{ trans('admin.name') }} </th>
                <th> {{ trans('admin.phone_code') }} </th>
                <th> {{ trans('admin.lang_code') }} </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($countries as $country)
                <tr>
                    <td>
                        {{ $country->name }}
                    </td>
                    <td>
                        {{ $country->phone_code }}
                    </td>
                    <td>
                        {{ $country->lang_code }}
                    </td>
                    <td>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit-country-{{ $country->id }}">
                            <i class="fa fa-edit"></i> 
                        </button>

                        <div class="modal fade" id="edit-country-{{ $country->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> {{ trans('admin.edit') }} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ route('admin_countries_update', ['id' => $country->id]) }}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-flag"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control" name="name" value="{{ $country->name }}" placeholder="{{ trans('admin.name') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-phone"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control" name="phone_code" value="{{ $country->phone_code }}" placeholder="{{ trans('admin.phone_code') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-language"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control" name="lang_code" value="{{ $country->lang_code }}" placeholder="{{ trans('admin.lang_code') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                {{ trans('admin.close') }}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                {{ trans('admin.update') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="new-country">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> {{ trans('admin.edit') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('admin_countries_store') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-flag"></i>
                                </span>
                            </div>
                            <input class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ trans('admin.name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>
                            <input class="form-control" name="phone_code" value="{{ old('phone_code') }}" placeholder="{{ trans('admin.phone_code') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-language"></i>
                                </span>
                            </div>
                            <input class="form-control" name="lang_code" value="{{ old('lang_code') }}" placeholder="{{ trans('admin.lang_code') }}">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{ trans('admin.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('admin.create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('bower_components/adminlte3/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/datatable.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/select2.js') }}"></script>
@endsection
