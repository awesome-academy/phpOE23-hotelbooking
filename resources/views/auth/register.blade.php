@extends('layouts.auth')

@section('title')
Register
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/adminlte3/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"> {{ trans('auth_forms.header_r') }} </p>

        <form action="{{ route('register') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ trans('auth_forms.username') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ trans('auth_forms.email') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <select class="select2" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }} ({{ $country->phone_code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('auth_forms.phone') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ trans('auth_forms.password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ trans('auth_forms.password2') }}">

                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                            {{ trans('auth_forms.agree') }} <a href="#">{{ trans('auth_forms.terms') }}</a>
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ trans('auth_forms.submit_r') }} </button>
                </div>
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- {{ trans('auth_forms.or') }} -</p>
            <a href="#" class="btn btn-block btn-primary">
                {{ trans('auth_forms.social_r') }} <i class="fab fa-facebook mr-2"></i>
            </a>
            <a href="#" class="btn btn-block btn-danger">
                {{ trans('auth_forms.social_r') }} <i class="fab fa-google-plus mr-2"></i>
            </a>
        </div>

        <a href="{{ route('login') }}" class="text-center">{{ trans('auth_forms.already_signup') }}</a>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('bower_components/adminlte3/select2/js/select2.full.min.js') }}"></script>
@endsection
