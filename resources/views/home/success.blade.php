@extends('layouts.home')

@section('title')
{{ trans('book_success.title') }}
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-header">
            {{ trans('booking_success.header') }}
        </h3>
    </div>
    <div class="card-body">
        <h4>{{ trans('booking_success.announce') }}</h4>
        <h5><a href="{{ route('home_index') }}">{{ trans('booking_success.back') }}</a></h5>
    </div>
</div>
@endsection
