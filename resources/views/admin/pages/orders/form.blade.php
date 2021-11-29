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
                <form action="{{route('admin.order.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (@$edit_mode)
                        @method('PUT')
                    @endif  
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <select class="form-select" id="user" name="user_id">
                            <option>Open this select user</option>
                            @foreach ($user as $item)
                            <option value="{{$item->id}}" {{@$edit_mode? $edit->user_id==$item->id:'' || old('user_id')==$item->id ?'selected':''}}>{{$item->name}}</option> 
                            @endforeach
                        </select>
                        @error('user_id')
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
    @if (@$edit_mode)
    <div class="col-12 col-md-6">
        <div class="card">
            <div class="card-header fw-bold">Add Items</div>
            <div class="card-body">
                <form action="{{route('admin.order.detail.update',$edit->id)}}" method="POST">
                    @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <select class="form-select" id="user" name="user_id">
                                <option>Open this select user</option>
                                @foreach ($user as $item)
                                <option value="{{$item->id}}" {{@$edit_mode? $edit->user_id==$item->id:'' || old('user_id')==$item->id ?'selected':''}}>{{$item->name}}</option> 
                            @endforeach
                        </select>
                        @error('user_id')
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