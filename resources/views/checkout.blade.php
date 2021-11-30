@extends('layouts.main')

@section('content')
<div class="mt-5 py-5 text-center container"> 
    <h2>Checkout form</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has
        a validation state that can be triggered by attempting to submit the form without completing it.</p>
</div>

<div class="row g-5 container mx-auto">
    @include('inc.alert')
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill">{{@$cart?$cart->sum('quantity'):0}}</span>
        </h4>
        <ul class="list-group mb-3">
            @foreach ($cart as $p_item)
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div>
                    <h6 class="my-0">{{$p_item->product->product_name}}</h6>
                    <small class="text-muted">{{$p_item->quantity.' x Rp.'.number_format($p_item->product->product_price,0)}}</small>
                </div>
                <span class="text-muted">{{'Rp.'.number_format($p_item->quantity*$p_item->product->product_price,0)}}</span>
            </li> 
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (Rp.)</span>
                <strong>{{'Rp.'.number_format(@$order->total?$order->total:0,0)}}</strong>
            </li> 
            <a href="{{route('order',$order->id)}}" class="mt-3 btn btn-primary w-100">Purchase Now</a>
            <a href="/" class="w-100 mt-3 btn btn-link">Add more item</a>
        </ul> 
    </div>
    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Items</h4>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SKU</th> 
                        <th scope="col">Name</th> 
                        <th scope="col">qty</th> 
                        <th scope="col">Price</th>  
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($cart as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->product->product_sku}}</td>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{'Rp.'.number_format($item->product->product_price,0)}}</td> 
                    </tr>  
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection