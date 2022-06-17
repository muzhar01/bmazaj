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
                        <li class="breadcrumb-item active">Edit Song</li>
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
                    <form action="{{ route('admin-audio-update') }}" method="post" enctype="multipart/form-data">
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
                                            placeholder="Category Name" value="{{ $audio->title }}">
                                        @if ($errors->has('title'))
                                            <span class="error">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" class="form-control" id="">
                                            <option>Select Category</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}" @php if($cat->id==$audio->category_id) echo "selected";else echo''; @endphp>{{ Str::ucfirst($cat->name) }}</option>
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
                                        @if($audio->thumbnail)
                                        <img src="{{ asset('/storage/media/audio/'. $audio->thumbnail) }}" width="100px" height="100px" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="exampleInputEmail1">Link</label>
                                        <input type="text" name="link" class="form-control"
                                            placeholder="Link"  value="{{ $audio->link }}">
                                        @if ($errors->has('link'))
                                            <span class="error">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea name="description" class="form-control" rows="5"> {{ $audio->description }}</textarea>
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
