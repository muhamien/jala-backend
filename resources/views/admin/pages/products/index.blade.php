@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{@$page_title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0"> 
        <a href="{{route('admin.product.create')}}" class="btn btn-primary">
            <span data-feather="plus"></span>
            Create new
        </a>
    </div>
</div>    
@include('inc.alert')
<div class="card">
    <div class="card-header fw-bold">Products</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">SKU</th> 
                        <th scope="col">Name</th> 
                        <th scope="col">Stock</th> 
                        <th scope="col">Price</th> 
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$item->product_sku}}</td> 
                        <td>{{$item->product_name}}</td> 
                        <td>{{$item->product_stock}}</td> 
                        <td>{{'Rp. '.number_format($item->product_price,0)}}</td> 
                        <td>
                            <form action="{{ route('admin.product.destroy',$item->id) }}"
                                onsubmit="return confirm('Confirm delete?')" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}   
                                <a href="{{route('admin.product.edit',$item->id)}}" class="btn btn-sm btn-success">Edit</a>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="modalDelete({{'id:'.$item->id.',name:'.$item->size}})">Delete</button> 
                            </form>  
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
            {{count($data)<1?'Data not found':''}}
        </div>
        <div class="col-md-12 mt-3">
            @if ($data->hasPages())
            {{ $data->links() }}
            @endif
        </div>
    </div>
</div>
@endsection

@section('include-css')
    
@endsection

@section('include-js')
    
@endsection