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
<div class="card card-primary">
    <div class="card-header">
        <h4> {{ trans('home.hello') }}! </h4>
    </div>
    <div class="card-body">
        <form method="post" action="#">
            <div class="row">
                <div class="col-md-7">
                    <select class="form-control select2">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}, {{ $city->country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control float-right" id="reservation" name="daterange">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3">
                    <input type="number" class="form-control @error('adult-count') is-invalid @enderror" min="{{ config('default.adult_min') }}" max="{{ config('default.adult_max') }}" name="adult-count" value="{{ old('adult-count') }}" placeholder="{{ trans('home.adult_num') }}">
                    @error('adult-count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control @error('children-count') is-invalid @enderror" min="{{ config('default.children_min') }}" max="{{ config('default.children_max') }}" name="children-count" value="{{ old('children-count') }}" placeholder="{{ trans('home.children_num') }}">
                    @error('children-count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <input type="number" class="form-control @error('room-count') is-invalid @enderror" min="{{ config('default.room_min') }}" max="{{ config('default.room_max') }}" name="room-count" value="{{ old('room-count') }}" placeholder="{{ trans('home.room_num') }}">
                    @error('room-count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-block btn-primary">
                        <i class="fa fa-search"></i>
                        <i class="fa fa-angle-double-right"></i>
                    </button>
                </div>
            </div>
            <br>
        </form>
    </div>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4> {{ trans('home.rand_city') }} </h4>
    </div>
    <div class="card-body">
        @foreach ($cityGroup as $group)
            <div class="row justify-content-center">
                @foreach ($group as $city)
                    <div class="col-md-4">
                        <a href="#">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if ($city->image != config('default.null_path') || $city->image != null)
                                            <img class="img-circle img-fluid" src="{{ asset('/storage/' . $city->image) }}">
                                        @else
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-city.jpg') }}">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <h3> {{ $city->name }} </h3>
                                        <h5> {{ $city->country->name }} </h5>
                                        @if ($city->description != config('default.null_path') || $city->description != null)
                                            <p> {{ $city->description }} </p>
                                        @else
                                            <p> {{ trans('home.nothing_to_show') }} </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h4> {{ trans('home.rand_hotel') }} </h4>
    </div>
    <div class="card-body">
        @foreach ($hotelGroup as $group2)
            <div class="row justify-content-center">
                @foreach ($group2 as $hotel)
                    <div class="col-md-3">
                        <a href="#">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-5">
                                        @if ($hotel->image != config('default.null_path') || $hotel->image != null)
                                            <img class="img-circle img-fluid" src="{{ asset('/storage/' . $hotel->image) }}">
                                        @else
                                            <img class="img-circle img-fluid" src="{{ asset('bower_components/adminlte3/default-hotel.png') }}">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <h3> {{ $hotel->name }} ({{ $hotel->rating }}<i class="fa fa-star"></i>) </h3>
                                        <h5> {{ $hotel->city->name }}, {{ $hotel->city->country->name }} </h5>
                                        <p> {{ $hotel->address }} </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
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
