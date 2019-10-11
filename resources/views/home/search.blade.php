@extends('layouts.home')

@section('title')
{{ trans('search.search') }} | {{ trans('search.result_num', ['res' => $resCount]) }}
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ trans('search.search') }} : {{ trans('search.result_num', ['res' => $resCount]) }}</h3>
    </div>
    <div class="card-body">
        @foreach ($hotels as $hotel)
            <div class="row">
                <div class="col-md-3">
                    <img class="img-thumbnail" src="{{ asset('bower_components/adminlte3/default-hotel.png') }}">
                </div>
                <div class="col-md-9">
                    <h2>{{ $hotel->name }} ({{ $hotel->rating }}<i class="fa fa-star"></i>)</h2>
                    <h4>{{ $hotel->city->name }}</h4>
                    <p>{{ $hotel->address }}</p>
                    <h5>{{ trans('search.room_left') }}</h5>
                    <ul>
                        @foreach($hotel->roomQuantities as $roomQuantity)
                            <li>
                                <b>{{ $roomQuantity->roomType->name }}</b> : {{ $roomQuantity->vacancy_quantity }} / {{ $roomQuantity->total_quantity }}
                            </li>
                        @endforeach
                    </ul>
                    @auth
                        <a class="btn btn-primary float-right" href="{{ route('home_booking', ['id' => $hotel->id]) }}">
                            {{ trans('search.book') }}
                        </a>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
    <div class="card-footer">

    </div>
</div>
@endsection
