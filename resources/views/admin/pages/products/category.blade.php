@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{@$page_title}}</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        {{-- <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
        </button> --}}
    </div>
</div>    
@include('inc.alert')
<div class="row g-3">
    <div class="col-12 col-md-4 order-sm-2">
        <div class="card">
            @if (@$edit_mode)
                <div class="card-header fw-bold">Form Edit</div>
            @else
                <div class="card-header fw-bold">Form Create</div>
            @endif
            <div class="card-body">
                <form action="{{@$edit_mode?route('admin.category.update',$edit->id):route('admin.category.store')}}" method="POST">
                    @csrf
                    @if (@$edit_mode)
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                        <input type="text" value="{{@$edit_mode?$edit->category_name:old('category_name')}}" name="category_name" class="form-control" id="exampleFormControlInput1" placeholder="Enter new category">
                        @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-auto">
                        @if (@$edit_mode)
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{route('admin.category.index')}}" class="btn btn-secondary">Cancel</a>
                        @else
                            <button type="submit" class="btn btn-primary">Create</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 order-sm-1">
        <div class="card">
            <div class="card-header fw-bold">Category</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th> 
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$item)
                            <tr>
                                <td>{{$data->firstItem() + $key}}</td>
                                <td>{{$item->category_name}}</td> 
                                <td>
                                    <form action="{{ route('admin.category.destroy',$item->id) }}"
                                        onsubmit="return confirm('Confirm delete?')" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}   
                                        <a href="{{route('admin.category.edit',$item->id)}}" class="btn btn-sm btn-success">Edit</a>
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
    </div>
</div>

@endsection

@section('include-css')
    
@endsection

@section('include-js')
    
@endsection