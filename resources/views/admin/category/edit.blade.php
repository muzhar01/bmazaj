@extends('admin.layouts.layout')
@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.Breadcum-End -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin-category-update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                      <input type="hidden" name="id" value="{{ $category->id }}">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Category Name" value="{{ $category->name }}">
                                        @if ($errors->has('name'))
                                            <span class="error">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleInputEmail1">Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if ($errors->has('image'))
                                            <span class="error">{{ $errors->first('image') }}</span>
                                        @endif
                                        @if($category->image)
                                        <img src="{{ asset('/storage/media/category/'. $category->image) }}" width="100px" height="100px" alt="">
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control">{{ $category->description }}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="error">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection