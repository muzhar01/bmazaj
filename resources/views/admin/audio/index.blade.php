@extends('admin.layouts.layout')
@section('container')
    <!-- Breadcum Start -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Audio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Audio</li>
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
                              <a href="{{ route('admin-add-audio') }}" class="btn btn-info float-right">Add Audio</a>
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Thumbnail</th>
                                        <th>Description</th>
                                        <th>Audio</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audio as $list)
                                    @php
                                      $i=1;
                                    @endphp
                                      <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $list->title }}</td>
                                        <td><img src="{{ asset('/storage/media/audio/'. $list->thumbnail) }}" height="100px" width="100px" alt=""></td>
                                        <td>{{ $list->description }}</td>
                                        <td>
                                          <audio controls>
                                            <source src="{{ asset('/storage/media/audio/file/'.$list->audio) }}">
                                          </audio>
                                        </td>
                                        <td>
                                          <div class="btn-group">
                                            <?php
                                              if($list->status==1){
                                                $class="success";
                                              }else{
                                                $class="danger";
                                              }
                                            ?>
                                            @if($list->status==1)
                                              <button type="button" class="btn btn-success">Active</button>
                                            @else
                                              <button type="button" class="btn btn-danger">Dective</button>
                                            @endif
                                            <button type="button" class="btn btn-{{ $class }} dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                              <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                              <a class="dropdown-item" href="{{ url('admin/audio/status/1/'.$list->id) }}">Active</a>
                                              <a class="dropdown-item" href="{{ url('admin/audio/status/0/'.$list->id) }}">Deactive</a>
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
                                              <a class="dropdown-item" href="{{ url('admin/audio/edit/'.$list->id) }}">Edit</a>
                                              <a class="dropdown-item" href="{{ url('admin/audio/delete/'.$list->id) }}">Delete</a>
                                            </div>
                                          </div>
                                        </td>
                                      </tr>
                                      @php
                                      $i++;
                                    @endphp
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
