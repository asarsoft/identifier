@extends('layouts.empty_master')
@section('style')
	<link href="{{ asset('application_css/authentication/floating-labels.css') }}" rel="stylesheet">
	<link href="{{ asset('application_css/authentication/login.css') }}" rel="stylesheet">
@endsection

@section('content')
	<form class="form-signin" method="POST" action="{{ route('attempt_login') }}">
        @csrf

		<div class="text-center mb-4">
			<img class="mb-4 rounded-circle shadow-sm" src="{{ asset('application_images/welcome/asar.jpg') }}" alt="" width="72" height="72">
            <h2 class="h2 mb-3 font-weight-normal">{{ trans('authentication.sign_in') }}</h2>
            <h4 class="h4 mb-3 font-weight-normal">{{ trans('heading.asarsoft_authentication') }}</h4>
		</div>

        @if($errors->has('message'))
            <div class="invalid-feedback d-block text-center pb-3 font-size-1">
                {{$errors->first('message')}}
            </div>
        @endif

        <div class="form-label-group">
			<input type="text" id="username_or_email" name="username_or_email" class="form-control" placeholder="{{ trans('authentication.username_or_email') }}" required autofocus value="{{ old('username_or_email') }}">
			<label for="username_or_email">{{ trans('authentication.username_or_email') }}</label>
            @if ($errors->has('username_or_email'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('username_or_email') }}
                </div>
            @endif

        </div>

		<div class="form-label-group">
			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
			<label for="password">{{ trans('authentication.password') }}</label>
            @if ($errors->has('password'))
                <div class="invalid-feedback d-block">
                    {{ $errors->first('password') }}
                </div>
            @endif
		</div>

        <div class="text-center mb-4">
            <p>Log in to any <b>Asarsoft</b> application vie <code>asarsoft authentication</code> service.
                Asarsoft Authentication assumes you accept
                <a href="https://caniuse.com/#feat=css-placeholder-shown">privacy and terms</a></p>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; {{ now()->year }} <b>{{ trans('app.name') }}</b></p>
	</form>
@endsection
