@extends('layouts.admin')

@section('title')
{{ trans('admin.hotels_title') }}
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
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#new-hotel">
            <i class="fa fa-plus"></i>&nbsp;&nbsp;{{ trans('admin.create') }} 
        </button>
    </div>
    <br>
    <table id="table1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th> {{ trans('admin.name') }} </th>
                <th> {{ trans('admin.city') }} </th>
                <th> {{ trans('admin.phone') }} </th>
                <th> {{ trans('admin.email') }} </th>
                <th> {{ trans('admin.rating') }} </th>
                <th> {{ trans('admin.image') }} </th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($hotels as $hotel)
                <tr>
                    <th> {{ $hotel->name }} </th>
                    <th> {{ $hotel->city->name }} </th>
                    <th> {{ $hotel->phone }} </th>
                    <th> {{ $hotel->email }} </th>
                    <th> {{ $hotel->rating }}<i class="fa fa-star"></i> </th>
                    <th>
                        <img src="{{ asset('/storage/' . $hotel->image) }}" alt="">
                    </th>
                    <th>
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#edit-hotel-{{ $hotel->id }}">
                            <i class="fa fa-edit"></i> 
                        </button>

                        <div class="modal fade" id="edit-hotel-{{ $hotel->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> {{ trans('admin.edit') }} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="{{ route('admin_hotels_update', ['id' => $hotel->id]) }}">
                                        {{ csrf_field() }}
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-building"></i>
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="text" name="name" value="{{ $hotel->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-road"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control select2" name="city_id">
                                                                @foreach ($cities as $city)
                                                                    @if ($city->id == $hotel->city_id)
                                                                        <option value="{{ $city->id }}" selected>
                                                                            {{ $city->name }}
                                                                        </option>
                                                                    @else
                                                                        <option value="{{ $city->id }}">
                                                                            {{ $city->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-map-pin"></i>
                                                                </span>
                                                            </div>
                                                            <textarea class="form-control" name="address">
                                                                {{ $hotel->address }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-envelope"></i>
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="text" name="email" value="{{ $hotel->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-phone"></i>
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="text" name="phone" value="{{ $hotel->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-star"></i>
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="number" name="rating" min="{{ config('default.yes') }}" max="{{ config('default.show_limit') }}" value="{{ $hotel->rating }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fa fa-image"></i>
                                                                </span>
                                                            </div>
                                                            <input class="form-control" type="file" name="image" enctype="multipart/form-data">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <strong>&nbsp;&nbsp;{{ trans('admin.roomlist') }}</strong>
                                            </div>
                                            <br>

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
                    </th>
                    <th>
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete-hotel-{{ $hotel->id }}">
                            <i class="fa fa-trash"></i>
                        </button>

                        <div class="modal fade" id="delete-hotel-{{ $hotel->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-header">
                                        <h4 class="modal-title"> {{ trans('admin.delete') }} </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p> {{ trans('admin.delete') }} {{ $hotel->name }} </p>
                                    </div>
                                    <form method="post" action="{{ route('admin_hotels_delete', ['id' => $hotel->id]) }}">
                                        {{ csrf_field() }}
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                {{ trans('admin.close') }}
                                            </button>
                                            <button type="submit" class="btn btn-outline-light">
                                                {{ trans('admin.delete') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="new-hotel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> {{ trans('admin.create') }} </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('admin_hotels_store') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-building"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-road"></i>
                                        </span>
                                    </div>
                                    <select class="form-control select2" name="city_id">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-map-pin"></i>
                                        </span>
                                    </div>
                                    <textarea class="form-control" name="address"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="number" name="rating" min="{{ config('default.yes') }}" max="{{ config('default.show_limit') }}" value="{{ config('default.yes') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-image"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="file" name="image" enctype="multipart/form-data">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <strong>&nbsp;&nbsp;{{ trans('admin.roomlist') }}</strong>
                    </div>
                    <br>

                    @foreach ($roomTypes as $roomType)
                        <div class="row">
                            <div class="col-md-2">
                                <b>{{ $roomType->name }}</b>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-cubes"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="number" name="{{ config('default.roomquantityrq') }}{{ $roomType->id }}" min="{{ config('default.no') }}" value="{{ config('default.yes') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-tachometer-alt"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="text" name="{{ config('default.pricerq') }}{{ $roomType->id }}" value="{{ config('default.no') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control select2" name="{{ config('default.currencyrq') }}{{ $roomType->id }}">
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
