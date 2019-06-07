<div class="position-fixed vh-100 bg-white pt-5 user_sidebar user_actions" id="user_actions">
    {{ Auth::user()->name }}
    <a class="nav-link" href="{{ route('logout-admin') }}">{{ trans('authentication.sign_out') }}</a>
</div>
