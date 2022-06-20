@extends('admin.layouts.layout')

@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Service Providers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add SP</li>
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
                    <form action="{{ route('admin-category-submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Add Service Provider</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- DSP Name -->
                                    <div class="col-6">
                                        <label for="spName">Name</label>
                                        <input id="spName" type="text" name="name" class="form-control" placeholder="Service Provider Name" value="{{ old('name') ?? '' }}">
                                        @if ($errors->has('name'))
                                            <span class="error">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <!-- DSP Link -->
                                    <div class="col-6">
                                        <label for="link">End Point Link</label>
                                        <input id="link" type="text" name="link" class="form-control" placeholder="Service Provider Link" value="{{ old('link') ?? '' }}">
                                        @if ($errors->has('link'))
                                            <span class="error">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>

                                <div class="row mb-3">
                                    <!-- Admin Email -->
                                    <div class="col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" name="email" class="form-control" placeholder="Enter Registered Email" value="{{ old('email') ?? '' }}">
                                        @if ($errors->has('email'))
                                            <span class="error">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" name="password" class="form-control" placeholder="Enter Password">
                                        @if ($errors->has('password'))
                                            <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Access Token -->
                                    <div class="col-9">
                                        <label for="token">Access Token (Optional)</label>
                                        <input id="token" type="text" name="token" class="form-control" placeholder="Enter token if available" value="{{ old('token') ?? '' }}">
                                        @if ($errors->has('token'))
                                            <span class="error">{{ $errors->first('token') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <label for="remember_me">Remember me</label>
                                        <input id="remember_me" type="checkbox" name="remember_me" class="form-control" value="{{ old('remember_me') ?? '' }}">
                                        
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <br>
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
