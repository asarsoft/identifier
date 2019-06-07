<footer class="py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-column flex-md-row border-bottom pb-2">
            <ul class="nav order-2 order-md-1">
                <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Enterprise</a></li>
            </ul>
            <h5 class="mr-0 mr-md-5 mb-0 order-1 order-md-2"><a href="#">{{ trans('app.name') }}</a></h5>
            <ul class="nav order-3 order-md-3">
                <li class="nav-item"><a class="nav-link" href="#">Support</a></li>
                <li class="nav-item"><a class="nav-link" href="#">ICO</a></li>
            </ul>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <p class="mb-0 mt-2 small text-muted">&copy; {{ now()->year }} <b>{{ trans('app.name') }}</b>. All right reserved.</p>
        </div>
    </div>
</footer>
