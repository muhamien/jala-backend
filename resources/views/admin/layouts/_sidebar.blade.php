<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Main</span> 
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin.dashboard.*')?'active':''}}" aria-current="page" href="#">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li> 
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Settings</span> 
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="settings"></span>
                    Profile
                </a>
            </li> 
        </ul>
    </div>
</nav>