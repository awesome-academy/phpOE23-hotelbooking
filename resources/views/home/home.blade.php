@extends('layouts.home')

@section('title')
{{ trans('home.page_index') }}
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('bower_components/adminlte3/plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<form method="post" action="#">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-plane"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="place">
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
                            <input type="number" class="form-control" min="{{ config('default.adult_min') }}" max="{{ config('default.adult_max') }}" name="adult-count">
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
                            <input type="number" class="form-control" min="{{ config('default.children_min') }}" max="{{ config('default.children_max') }}" name="children-count">
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
                            <input type="number" class="form-control" min="{{ config('default.room_min') }}" max="{{ config('default.room_max') }}" name="room-count">
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
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                
            </div>
            <div class="card-body">
                <div class="row">

                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="row">

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
@endsection
