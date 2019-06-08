<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link s_b_anchor @if(Request::route()->getName() == 'dashboard-admin') active @endif" href="{{ route('dashboard-admin') }}">
                    <i class="mr-2 s_b_icons fas fa-satellite"></i>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link s_b_anchor" href="#">
                    <i class="mr-2 s_b_icons fas fa-receipt"></i>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link s_b_anchor" href="#">
                    <i class="mr-2 s_b_icons fas fa-mail-bulk"></i>
                    Projects
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link s_b_anchor" href="#">
                    <i class="mr-2 s_b_icons fas fa-user-friends"></i>
                    Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link s_b_anchor" href="#">
                    <i class="mr-2 s_b_icons fas fa-balance-scale"></i>
                    Terms
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link s_b_anchor " href="{{ route('index-feature') }}">
                    <i class="mr-2 s_b_icons fas fa-clipboard-check"></i>
                    Feature
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link s_b_anchor" href="#">
                    <i class="mr-2 s_b_icons fas fa-code-branch"></i>
                    Categories
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Accepted Projects</span>
            <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
            </li>
        </ul>
    </div>
</nav>
