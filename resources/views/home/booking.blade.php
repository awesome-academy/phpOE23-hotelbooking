@extends('layouts.home')

@section('title')
{{ trans('booking.page') }}
@endsection

@section('css')

@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{ trans('booking.booking_card') }}
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ trans('booking.customer_info') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <img class="img-thumbnail" src="{{ asset('bower_components/adminlte3/default-user.jpg') }}">
                        <label>{{ trans('booking.name') }}</label> {{ Auth::user()->name }}
                        <br>
                        <label>{{ trans('booking.phone') }}</label> {{ Auth::user()->country->phone_code }} {{ Auth::user()->phone }}
                        <br>
                        <label>{{ trans('booking.email') }}</label> {{ Auth::user()->email }}
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ trans('booking.booking_info') }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('home_booking_post') }}">
                            {{ csrf_field() }}
                            <label>{{ trans('booking.hotel') }}</label>
                            <input class="form-control" name="hotel_id" value="{{ $hotel->id }}" hidden>
                            <input class="form-control" value="{{ $hotel->name }}" readonly>

                            <label>{{ trans('booking.check_in') }}</label>
                            <input class="form-control" name="checkin" value="{{ session('check-in') }}" readonly>

                            <label>{{ trans('booking.check_out') }}</label>
                            <input class="form-control" name="checkout" value="{{ session('check-out') }}" readonly>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-male"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" name="adult-count" value="{{ sesion('adult-count') }}" readonly>
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
                                            <input class="form-control" name="children-count" value="{{ sesion('children-count') }}" readonly>
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
                                            <input class="form-control" name="room-count" value="{{ sesion('room-count') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-money"></i>
                                                </span>
                                            </div>
                                            <select class="form-control select2" name="currency_id">
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}">
                                                        {{ $currency->name }} ({{ $currency->symbol }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <label>{{ trans('booking.choose') }}</label>
                            <input id="sum" readonly>
                            <div class="card">
                                <div class="card-body" id="choose">
                                    @foreach ($hotel->roomQuantities as $roomQuantity)
                                        @if ($roomQuantity->vacancy_quantity > config('default.no'))
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>
                                                        {{ $roomQuantity->roomType->name }}
                                                    </label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" class="form-control" name="rq-{{ $roomQuantity->id }}" max="{{ $roomQuantity->vacancy_quantity }}" value="{{ config('default.no') }}">
                                                </div>   
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">
                                {{ trans('booking.submit') }}
                            </button>
                        </form>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection

@section('js')

@endsection
