@extends('layouts.login')

@section('content')

<div class=" col-12">
    <div class="row">
        <div class="col-12 right_form">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-15">
                        <img src="{{ asset('assets/img/rio_care_logo.png') }}"
                            alt="RIOCare Inventory and Stock Management" style="max-width:150px;">
                        <p>Inventory and Stock Management</p>
                    </span>
                    <span class="login100-form-title p-b-48 pt-3">
                        {{ __('Login') }}
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Please Enter email">
                        <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Please Enter Password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye-off"></i>
                        </span>
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row forgot">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="flexCheckDefault" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
