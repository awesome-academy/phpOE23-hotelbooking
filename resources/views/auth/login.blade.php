@extends('layouts.auth')

@section('title')
Login
@endsection

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{ trans('auth_forms.header_l') }}</p>

        <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ trans('auth_forms.email') }}">
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
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ trans('auth_forms.password') }}">
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
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            {{ trans('auth_forms.remember') }}
                        </label>
                    </div>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('auth_forms.submit_l') }}</button>
                </div>
            </div>
        </form>

        <div class="social-auth-links text-center mb-3">
            <p>- {{ trans('auth_forms.or') }} -</p>
            <a href="#" class="btn btn-block btn-primary">
                {{ trans('auth_forms.social_l') }} <i class="fab fa-facebook mr-2"></i>
            </a>
            <a href="#" class="btn btn-block btn-danger">
                {{ trans('auth_forms.social_l') }} <i class="fab fa-google-plus mr-2"></i>
            </a>
        </div>
        <p class="mb-1">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"> {{ trans('auth_forms.forgot_pass') }} </a>
            @endif
        </p>
        <p class="mb-0">
            <a href="{{ route('register') }}" class="text-center"> {{ trans('auth_forms.new_acc') }} </a>
        </p>
    </div>
</div>
@endsection
