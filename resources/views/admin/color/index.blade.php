@extends('admin.layouts.layout')
@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Font Color</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Color</li>
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
                    <form action="{{ route('admin-color-submit') }}" method="post" >
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
                                <h3 class="card-title">Add Color</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="color">Back Color</label>
                                        <small>Font color for the flip card back</small>
                                        <input id="color" type="color" name="color" class="form-control"
                                            value="{{ $color->color ?? '' }}" style="height:50px !important;">
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
