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
                        @if(count($sps) > 0)
                            <table id="spTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Email/Username</th>
                                        <th>Token</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="row_position">

                                    @foreach ($sps as $sp)

                                      <tr id="{{ $sp->id }}">
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td>{{ $sp->name ?? ''}}</td>
                                        <td>{{ $sp->email }}</td>
                                        <td>{{ $sp->token ? substr(($sp->token ?? ''), 0,8) . ' ...' : 'No token' }}</td>
                                        <td>
                                          <div class="btn-group">
                                            
                                            @if($sp->status==1)
                                              <button type="button" class="btn btn-success">Active</button>
                                            @else
                                              <button type="button" class="btn btn-danger">Deactive</button>
                                            @endif
                                            <button type="button" class="btn btn-{{ $sp->status == 1 ? 'success' : 'danger' }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="{{ route('sp-settings.show',$sp->id) ."?status=1" }}">Active</a>
                                              <a class="dropdown-item" href="{{ route('sp-settings.show',$sp->id) ."?status=0" }}">Deactive</a>
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
                                              <a class="dropdown-item" href="{{ route('sp-settings.edit', $sp->id) }}">Edit</a>
                                              <form action="{{ route('sp-settings.destroy', $sp->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a class="dropdown-item" href="#"><button class="border-0" type="submit">Delete</button></a>
                                              </form>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          @else
                            <h3 class="h3 text-center">No Recods</h3>
                            <hr>
                          @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

@endsection
