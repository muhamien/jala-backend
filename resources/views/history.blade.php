@extends('layouts.main')

@section('content')
@include('inc.alert')
<div class="mt-5 py-5 text-center container"> 
    <h2>Transaction History</h2>
     
</div>

<div class="row g-5 container mx-auto"> 
    <div class="col-md-12 col-lg-12">
        <h4 class="mb-3">Items</h4>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Invoice</th> 
                        <th scope="col">Total</th> 
                        <th scope="col">Status</th>  
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($data as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->invoice==null?'Coming soon':$item->invoice;}}</td>
                        <td>{{'Rp.'.number_format($item->total,0)}}</td> 
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
                    </tr>  
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection