@extends('admin.layouts.layout')
@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Song</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Song</li>
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
                    <form action="{{ route('admin-audio-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Add Song</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" class="form-control"
                                            placeholder="Category Name">
                                        @if ($errors->has('title'))
                                            <span class="error">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" class="form-control" id="">
                                            <option>Select Category</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ Str::ucfirst($cat->name) }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_id'))
                                            <span class="error">{{ $errors->first('category_id') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Thumbnail</label>
                                        <input type="file" name="thumbnail" class="form-control">
                                        @if ($errors->has('thumbnail'))
                                            <span class="error">{{ $errors->first('thumbnail') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Audio</label>
                                        <input type="file" name="audio" class="form-control">
                                        @if ($errors->has('audio'))
                                            <span class="error">{{ $errors->first('audio') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control" rows="5"></textarea>
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
