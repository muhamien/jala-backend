@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{@$page_title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{route('admin.order.index')}}" class="btn btn-secondary">Back</a>
    </div>
</div>    

<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header fw-bold">Customer</div>
            <div class="card-body">
                <form action="{{route('admin.order.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (@$edit_mode)
                        @method('PUT')
                    @endif  
                    <div class="mb-3"> 
                        <ul class="list-group">
                            <li class="list-group-item border-0">Nama: {{$edit->user->name}}</li>
                            <li class="list-group-item border-0">Email: {{$edit->user->email}}</li> 
                        </ul>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    @if (@$edit_mode)
    <div class="col-12">
        @include('inc.alert')
        <div class="card">
            <div class="card-header fw-bold">Add Items</div>
            <div class="card-body"> 
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Item</th>
                              <th scope="col">qty</th>
                              <th scope="col">Price</th>
                              @if ($edit->status == 0)
                              <th scope="col">Action</th>
                              @endif
                            </tr>
                          </thead>
                          <tbody>
                              @foreach ($items as $key=>$item)
                              <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$item->product->product_name}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{'Rp. '.number_format($item->product->product_price,0)}}</td>
                                @if ($edit->status == 0)
                                <td>
                                    <div class="col-auto"> 
                                        <button type="submit" class="btn btn-warning">Edit</button> 
                                        <button type="submit" class="btn btn-danger">Delete</button> 
                                    </div>  
                                </td>
                                @endif
                              </tr> 
                              @endforeach
                              @if ($edit->status == 0 ||$edit->status == 3 )
                              <tr>
                                  <form action="{{route('admin.order.detail.add',['order'=>$edit->id])}}" method="POST">
                                      @csrf 
                                  <td></td>
                                  <td colspan="1">
                                      <div class="mb-3"> 
                                          <select class="form-select" id="user" name="product_id">
                                              <option value="">Open this select product</option>
                                              @foreach ($product as $item)
                                              <option value="{{$item->id}}" {{@$edit_mode? $edit->product_id==$item->id:'' || old('product_id') == $item->id ?'selected':'' . $item->product_stock<1?' disabled':''}}>{{$item->product_name.' (Rp. '.number_format($item->product_price,0).')'}}</option> 
                                              @endforeach
                                          </select>
                                          @error('product_id')
                                          <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                  </td>
                                  <td>
                                      <div class="mb-3"> 
                                          <input type="number" value="" name="quantity" min="1" class="form-control" id="exampleFormControlInput1" placeholder="Enter number of quantity">
                                          @error('quantity')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                  </td>
                                  <td>
  
                                  </td>
                                  <td>
                                      <div class="col-auto"> 
                                          <button type="submit" class="btn btn-success w-100">Add</button> 
                                      </div>       
                                  </td>
                                  </form>
                              </tr>
                              @endif
                            <tr> 
                                <td colspan="3" class="text-center"><b>Total</b></td>
                                <td class="fw-bold">Rp. {{number_format($edit->total,0)}}</td> 
                                @if ($edit->status == 0||$edit->status == 3)
                                <td> 
                                    <a href="{{route('admin.order.process',$edit->id)}}" class="btn btn-primary w-100 {{$edit->total<1||$edit->status==0||$edit->status == 3 ? '':'disabled'}}">Process</button> 
                                </td>
                                @endif
                              </tr> 
                          </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
    @endif  
</div>
@endsection

@section('include-css')
    
<link href="{{asset('')}}assets/vendor/dropify/dist/dropify.min.css" rel="stylesheet"/>

@endsection

@section('include-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{asset('')}}assets/vendor/dropify/dist/dropify.min.js"></script>
    <script>
        $(function() {
            'use strict';

            $('#myDropify').dropify();
        });
    </script>
@endsection