<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Album example · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/apple-touch-icon.png"
        sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32"
        type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16"
        type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/safari-pinned-tab.svg"
        color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .cart-dropdown{
            width: 350px;
            padding: 12px;
        } 
        .cart-dropdown ::-webkit-scrollbar {
            display: block;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    @yield('include-css')

</head>

<body>
    <header class="p-3 bg-dark text-white fixed-top">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <i class="bi bi-cart-check-fill h2"></i>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ms-5">
              <li><a href="/" class="nav-link px-2 text-light">Home</a></li> 
              <li><a href="{{@Auth::user()->id?route('history',auth()->user()->id):''}}" class="nav-link px-2 text-light" {{@Auth::user()->id?'':'hidden="hidden"'}}>My Orders</a></li> 
            </ul>
            
            {{-- <div class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">  --}}
                <!-- Example single danger button -->
                <div class="btn-group me-3">
                    <button type="button" class="btn btn-primary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bag-fill"></i>
                        Cart
                        @if (@$cart) 
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-4 border-dark">
                            {{@$cart->sum('quantity')}}
                            <span class="visually-hidden">unread messages</span>
                        </span> 
                        @endif
                    </button> 
                    <ul class="dropdown-menu cart-dropdown mt-4 shadow-sm">
                        @if(@$cart)
                        <div class="row total-header-section"> 
                            <nav class="d-grid gap-2 col-12 overflow-scroll" style="max-height: 400px;">
                                @foreach(@$cart as $key => $cart_item) 
                                <div class="text-dark text-decoration-none btn-hover-light d-flex align-items-center gap-3 py-2 px-2 lh-sm">
                                    <div class="overflow-hidden rounded rounded-5" style="width: 60px;">
                                        <img src="{{asset('uploads/'.$cart_item->product->product_image)}}" alt="" class="img-fluid">
                                    </div>
                                    <div class="text-left w-100">
                                        <strong class="d-block">{{$cart_item->product->product_name}}</strong>
                                        <small>{{$cart_item->quantity.' x Rp.'.number_format($cart_item->product->product_price,0)}}</small>
                                    </div>
                                    <a href="{{route('remove_from_cart',$cart_item->id)}}" class="btn btn-sm btn-dark"><i class="bi bi-dash"></i></a>
                                    <a href="{{route('add_to_cart',$cart_item->product->id)}}" class="btn btn-sm btn-dark {{$cart_item->product->product_stock==0?'disabled':''}}"><i class="bi bi-plus"></i></a>
                                </div>  
                                @endforeach
                            </nav>
                        </div> 
                        <hr/>
                        <div class="row px-3">
                            <div class="col-lg-12 col-sm-12 col-12 d-flex justify-content-between">
                                    <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                        <p class="fw-bold">Total: <span class="text-info">{{'Rp.'.number_format($order->total,0)}}</span></p>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">View All</a>
                                </div>
                            </div>
                        @else
                        <div class="d-flex justify-content-center my-3">
                            <h4 class="text-muted text-center"><i class="bi bi-bag-fill"></i> <br/>Cart is empty!</h4>
                        </div>
                        @endif
                    </ul>
                </div>  
            {{-- </div> --}}
    
            @if (Route::has('login'))
                <div class="text-end">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf 
                        <x-responsive-nav-link class="btn btn-danger" :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
          </div>
        </div>
      </header> 

    <main>
        @yield('content') 
    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p> 
        </div>
    </footer>


    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('include-js')

</body>

</html>