@extends('layouts.empty_master')
@section('styles')
	<link href="{{ asset('application_css/authentication/floating-labels.css') }}" rel="stylesheet">
@endsection

@section('content')
	<form class="form-signin">
		<div class="text-center mb-4">
			<img class="mb-4 rounded-circle shadow-sm" src="{{ asset('application_images/welcome/asar.jpg') }}" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">{{ trans('heading.asarsoft_authentication') }}</h1>
			<p>Log in to any <b>Asarsoft</b> application vie <code>asarsoft authentication</code> service.
				Asarsoft Authentication assumes you accept <a href="https://caniuse.com/#feat=css-placeholder-shown">privacy and terms</a></p>
		</div>

		<div class="form-label-group">
			<input type="text" id="username_email" class="form-control" placeholder="{{ trans('authentication.username_email') }}" required autofocus>
			<label for="username_email">{{ trans('authentication.username_email') }}</label>
		</div>

		<div class="form-label-group">
			<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
			<label for="inputPassword">{{ trans('authentication.password') }}</label>
		</div>

		<div class="checkbox mb-3">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="customCheck1">
				<label class="custom-control-label" for="customCheck1">{{ trans('authentication.remember_me') }}</label>
			</div>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		<p class="mt-5 mb-3 text-muted text-center">&copy; {{ now()->year }} <b>{{ trans('app.name') }}</b></p>
	</form>
@endsection