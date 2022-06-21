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
                        <li class="breadcrumb-item active">Service Providers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.Breadcum-End -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                              <a href="{{ route('sp-settings.create') }}" class="btn btn-info float-right">Add Service Provider</a>
                            </div>
                        </div>

                        @if(session()->has('success'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif

                        @if(session()->has('error'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        @endif

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="spTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="row_position">
                                    @foreach ($sps as $sp)
                                      <tr id="{{ $sp->id }}">
                                        <td>{{ $i }}</td>
                                        <td>{{ $sp->name }}</td>
                                        <td><img src="{{ asset('/storage/media/category/'. $sp->image) }}" height="200px" width="200px" alt=""></td>
                                        <td>{{ $sp->description }}</td>
                                        <td>
                                          <div class="btn-group">
                                            <?php
                                              if($sp->status==1){
                                                $class="success";
                                              }else{
                                                $class="danger";
                                              }
                                            ?>
                                            @if($sp->status==1)
                                              <button type="button" class="btn btn-success">Active</button>
                                            @else
                                              <button type="button" class="btn btn-danger">Dective</button>
                                            @endif
                                            <button type="button" class="btn btn-{{ $class }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="{{ url('admin/category/status/1/'.$sp->id) }}">Active</a>
                                              <a class="dropdown-item" href="{{ url('admin/category/status/0/'.$sp->id) }}">Deactive</a>
                                            </div>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                              <a class="dropdown-item" href="{{ url('admin/category/edit/'.$sp->id) }}">Edit</a>
                                              <a class="dropdown-item" href="{{ url('admin/category/delete/'.$sp->id) }}">Delete</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
