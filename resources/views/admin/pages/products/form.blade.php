@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{@$page_title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        {{-- <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Back</a> --}}
    </div>
</div>    

<div class="row">
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header fw-bold">Form Create</div>
            <div class="card-body">
                <form action="{{@$edit_mode?route('admin.product.update',$edit->id):route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (@$edit_mode)
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Image</label>
                        <input type="file" id="myDropify" name="product_image" class="border" data-default-file="{{@$edit_mode? asset('uploads/'.$edit->product_image):null}}"/>
                        @error('product_image')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Code</label>
                        <input type="text" {{@$edit_mode?'readonly':''}} value="{{@$edit_mode?$edit->product_sku:old('product_sku')}}" name="product_sku" class="form-control" id="exampleFormControlInput1" placeholder="Enter Product Code">
                        @error('product_sku')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                        <input type="text" value="{{@$edit_mode?$edit->product_name:old('product_name')}}" name="product_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter new product name">
                        @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Price</label>
                        <input type="number" value="{{@$edit_mode?$edit->product_price:old('product_price')}}" name="product_price" class="form-control" id="exampleFormControlInput1" placeholder="Enter new product price">
                        @error('product_price')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Stock</label>
                        <input type="number" value="{{@$edit_mode?$edit->product_stock:old('product_stock')}}" name="product_stock" class="form-control" id="exampleFormControlInput1" placeholder="Enter new product stock">
                        @error('product_stock')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category_id">
                            <option>Open this select category</option>
                            @foreach ($category as $item)
                            <option value="{{$item->id}}" {{@$edit_mode? $edit->category_id==$item->id:'' || old('category_id')==$item->id ?'selected':''}}>{{$item->category_name}}</option> 
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-auto">
                        @if (@$edit_mode)
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Cancel</a>
                        @else
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{route('admin.product.index')}}" class="btn btn-secondary">Cancel</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
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