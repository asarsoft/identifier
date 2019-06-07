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
    <link href="{{ asset('application_css/admin/style.css') }}" rel="stylesheet">
    @include('includes.general_css')

    <link rel="stylesheet" href="{{ asset('application_css/admin/dashboard.css') }}">
</head>
<body>


@include('admin_views.includes.admin_navbar')
<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @include('admin_views.includes.admin_side_navbar')
            @yield('content')
        </main>
    </div>
</div>
@include('admin_views.includes.user_actions')

@include('includes.general_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

<script src="{{ asset('application_js/admin/dashboard.js') }}"></script>

</body>
</html>
