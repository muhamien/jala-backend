@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{@$page_title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0"> 
        <a href="{{route('admin.order.create')}}" class="btn btn-primary">
            <span data-feather="plus"></span>
            Create Purchase Order
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
                        <th scope="col">Invoice</th> 
                        <th scope="col">Nama</th> 
                        <th scope="col">Total</th> 
                        <th scope="col">Status</th> 
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$data->firstItem() + $key}}</td>
                        <td>{{$item->invoice}}</td> 
                        <td>{{$item->user->name}}</td> 
                        <td>{{'Rp. '.number_format($item->total,0)}}</td> 
                        <td>
                            @if ($item->status==1)
                            <span class="badge bg-success">Success</span>
                            @elseif($item->status==2)
                            <span class="badge bg-primary">Process</span>
                            @elseif($item->status==3)
                            <span class="badge bg-warning">Pending</span> 
                            @elseif($item->status==4)
                            <span class="badge bg-danger">Failed</span> 
                            @endif 
                        </td> 
                        <td>
                            <form action="{{ route('admin.product.destroy',$item->id) }}"
                                onsubmit="return confirm('Confirm delete?')" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}   
                                @if ($item->status==2)
                                    <a href="{{route('admin.order.complete',$item->id)}}" class="btn btn-sm btn-success">Complete</a>
                                @endif
                                <a href="{{route('admin.order.detail',$item->id)}}" class="btn btn-sm btn-info">Detail</a> 
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