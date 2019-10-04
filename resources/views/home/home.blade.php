@extends('layouts.home')

@section('title')
{{ trans('home.page_index') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
<form method="post" action="#">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-plane"></i>
                                </span>
                            </div>
                            <select class="form-control select2" name="place">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="reservation" name="daterange">
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-tachometer-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" id="date-diff" name="daterange-len">
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
                                    <i class="fa fa-male"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" min="{{ config('default.adult_min') }}" max="{{ config('default.adult_max') }}" name="adult-count" placeholder="{{ trans('home.adult_num') }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-child"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" min="{{ config('default.children_min') }}" max="{{ config('default.children_max') }}" name="children-count" placeholder="{{ trans('home.children_num') }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-home"></i>
                                </span>
                            </div>
                            <input type="number" class="form-control" min="{{ config('default.room_min') }}" max="{{ config('default.room_max') }}" name="room-count" placeholder="{{ trans('home.room_num') }}">
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-block btn-primary">
                                    <i class="fa fa-search"></i>
                                    <i class="fa fa-angle-double-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ trans('home.rand_city') }}</h3>
            </div>
            <div class="card-body">
                @foreach ($cityList as $city)
                    <div class="row">
                        <a class="btn btn-block btn-default" href="#">
                            <div class="row">
                                <div class="col-md-3">
                                    @if ($city->image == config('default.null_path'))
                                        <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-city.jpg') }}">
                                    @else
                                        <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-city.jpg') }}">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <b>{{ $city->name }}</b><br>
                                    <p>{{ $city->country->name }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ trans('home.rand_hotel') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($hotels as $hotel)
                        <div class="row">
                            <a class="btn btn-block btn-default" href="#">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($hotel->image == config('default.null_path'))
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-hotel.png') }}">
                                        @else
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-hotel.png') }}">
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <b>{{ $hotel->name }} ({{ $hotel->rating }}<i class="fa fa-star"></i>)</b><br>
                                        <p>{{ $hotel->city->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ trans('home.rand_room_type') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($roomTypes as $roomType)
                        <div class="row">
                            <a class="btn btn-block btn-default" href="#">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($roomType->image == config('default.null_path'))
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-room.png') }}">
                                        @else
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-room.png') }}">
                                        @endif
                                    </div>
                                    <div class="col-md-9">
                                        <b>{{ $roomType->name }}</b><br>
                                        <b>{{ $roomType->capacity }} <i class="fa fa-male"></i></b>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('bower_components/adminlte3/plugins/inputmask/jquery.inputmask.bundle.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/adminlte3/daterangepicker.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('bower_components/adminlte3/select2.js') }}"></script>
@endsection
