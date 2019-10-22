@extends('layouts.admin')

@section('title')
{{ trans('admin.cities_title') }}
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
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#new-city">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ trans('admin.create') }} 
        </button>
    </div>
    <br>
    <table id="table1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> {{ trans('admin.name') }} </th>
                <th> {{ trans('admin.country') }} </th>
                <th> {{ trans('admin.image') }} </th>
                <th> {{ trans('admin.description') }} </th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
                <tr>
                    <td>
                        {{ $city->name }}
                    </td>
                    <td>
                        {{ $city->country->name }}
                    </td>
                    <td>
                        <img src="{{ asset('/storage/') . $city->image }}">
                    </td>
                    <td>
                        {{ $city->description }}
                    </td>
                    <td>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit-country-{{ $city->id }}">
                            <i class="fa fa-edit"></i> 
                        </button>

                        <div class="modal fade" id="edit-country-{{ $city->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> {{ trans('admin.edit') }} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ route('admin_cities_update', ['id' => $city->id]) }}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-city"></i>
                                                        </span>
                                                    </div>
                                                    <input class="form-control" name="name" value="{{ $city->name }}" placeholder="{{ trans('admin.name') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-flag"></i>
                                                        </span>
                                                    </div>
                                                    <select class="form-control select2" name="country_id">
                                                        @foreach ($countries as $country)
                                                            @if ($city->country_id == $country->id)
                                                                <option value="{{ $country->id }}" selected>
                                                                    {{ $country->name }}
                                                                </option>
                                                            @else
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-image"></i>
                                                        </span>
                                                    </div>
                                                    <input type="file" class="form-control" name="image" enctype="multipart/form-data">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fa fa-asterisk"></i>
                                                        </span>
                                                    </div>
                                                    <textarea class="form-control" name="description">
                                                        {{ $city->description }}
                                                    </textarea>
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

<div class="modal fade" id="new-city">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> {{ trans('admin.create') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('admin_cities_store') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-city"></i>
                                </span>
                            </div>
                            <input class="form-control" name="name" value="{{ old('name') }}" placeholder="{{ trans('admin.name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-flag"></i>
                                </span>
                            </div>
                            <select class="form-control select2" name="country_id">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-image"></i>
                                </span>
                            </div>
                            <input type="file" class="form-control" name="image" enctype="multipart/form-data">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-asterisk"></i>
                                </span>
                            </div>
                            <textarea class="form-control" name="description"></textarea>
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
