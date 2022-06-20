@extends('admin.layouts.layout')
@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Logo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Logo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.Breadcum-End -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <form action="{{ route('admin-logo-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <h3 class="card-title">Add Logo</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="exampleInputEmail1">Image</label>
                                        <input type="file" name="image" class="form-control">
                                        @if ($errors->has('image'))
                                            <span class="error">{{ $errors->first('image') }}</span>
                                        @endif
                                        <br>
                                        @if ($logo)
                                            <img src="{{ asset('/storage/media/logo/' . $logo->image) }}" height="100px"
                                                width="100px  " alt="">
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
