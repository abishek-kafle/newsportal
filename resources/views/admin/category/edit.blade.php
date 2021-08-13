@extends('admin.includes.admin_design')

@section('title')
    Edit Category {{$category->category_name}} - {{config('app.name','News')}}
@endsection

@section('content')
    <!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Add Category</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="{{route('category.index')}}" class="btn add-btn"><i class="fa fa-eye"></i>View All Categories</a>
                </div>
            </div>
        </div>

        @include('admin.includes._message')
        <!-- /Page Header -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('category.update',$category->id)}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Under Category</label>
                                        <select name="parent_id" id="parent_id" class="form-control">
                                            <option value="0">Main Category</option>
                                            @foreach ($categories as $data)
                                                <option value="{{$data->id}}" @if ($data->id == $category->parent_id) selected @endif>{{$data->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="category_name" value="{{$category->category_name}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category_name">Category Description</label>
                                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$category->description}}</textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check" data-children-count="1">
                                            <input type="checkbox" class="form-check-input" value="1" name="status" id="status" @if ($category->status == 1) checked @endif>
                                            <label for="status" class="form-check-label">
                                                Mark as Active
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
