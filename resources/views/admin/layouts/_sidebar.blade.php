<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Main</span> 
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin.dashboard.*')?'active':''}}" aria-current="page" href="{{route('admin.dashboard.index')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li> 
            <li class="nav-item">
                <a class="nav-link collapsed {{Route::is('admin.product.*') || Route::is('admin.category.*')?'active':''}}" href="{{route('admin.product.index')}}" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                    <span class="d-flex justify-content-between align-items-center">
                        <div>
                            <span data-feather="shopping-cart"></span>
                            Products
                        </div>
                        <span data-feather="plus-circle"></span>
                    </span>
                </a> 
                <div class="collapse {{Route::is('admin.product.*') || Route::is('admin.category.*')?'show':''}}" id="home-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small"> 
                    <li class="ml-5"><a class="nav-link {{Route::is('admin.category.*')?'active':''}}" style="padding-left: 42px;" href="{{route('admin.category.index')}}"> 
                        Categories
                    </a></li> 
                    <li class="ml-5"><a class="nav-link {{Route::is('admin.product.*')?'active':''}}" style="padding-left: 42px;" href="{{route('admin.product.index')}}"> 
                        Products
                    </a></li> 
                  </ul>
                </div>
              </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('admin.order.*')?'active':''}}" href="{{route('admin.order.index')}}">
                    <span data-feather="file"></span>
                    Orders
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