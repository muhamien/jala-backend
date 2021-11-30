@extends('layouts.main')

@section('content')
<section class="mt-5 py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Hay, {{@Auth::user()->name?strtok(Auth::user()->name," "):'Welcome'}}</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                entirely.</p> 
        </div>
    </div>
</section>
    
<div class="album py-5 bg-light">
    <div class="container">
        @include('inc.alert')
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($data as $item)
                <div class="col {{$item->product_stock == 0?'text-muted':''}}">
                    <div class="card shadow-sm">
                        <div class="overflow-hidden">
                            <img src="{{asset('uploads/'.$item->product_image)}}" alt="{{$item->product_name}}" class="img-fluid w-100">
                        </div> 
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6 class="card-text">{{$item->product_name}}</h6>
                                <b class="text-danger">{{'Rp.'.number_format($item->product_price,0)}}</b>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($item->product_stock == 0)
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-outline-primary disabled">Add to Cart</a> 
                                    <span class="px-3 fw-bold">[Out of stock]</span>
                                </div> 
                                    
                                @else
                                <div class="btn-group">
                                    <a href="{{route('add_to_cart',$item->id)}}" class="btn btn-sm btn-outline-primary">Add to Cart</a> 
                                </div> 
                    
                                @endif
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('include-css')
    
@endsection
@section('include-js')
 
@endsection