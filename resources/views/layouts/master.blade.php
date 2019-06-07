<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Styles -->
    @include('includes.general_css')
    @yield('style')
</head>
<body>

<div class="container-fluid p-0">

	@include('includes.web_navbar')
	@yield('content')
    @include('includes.web_footer')
</div>

@include('includes.general_js')
@yield('script')

</body>
</html>