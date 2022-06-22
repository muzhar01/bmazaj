@extends('admin.layouts.layout')
@section('container')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Admin Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset('/storage/media/admin/'.$data->image) }}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ ucfirst($data->name) }}</h3>


              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right">{{ $data->email }}</a>
                </li>
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change Password</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
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
              <div class="tab-content">
                <div class="active tab-pane" id="activity">
                  
                  <form class="form-horizontal" method="post" action="{{ route('admin-profile-update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="name" class="form-control" id="inputName" name="name" value="{{ $data->name ?? old('name') ?? '' }}" placeholder="Name">
                      </div>
                      
                      @if ($errors->has('name'))
                      <span class="error">{{ $errors->first('name') }}</span>
                  @endif
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" value="{{ $data->email ?? old('email') ?? '' }}" name="email" placeholder="Email">
                      </div>
                      @if ($errors->has('email'))
                          <span class="error">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Image</label>
                      <div class="col-sm-10">
                        <input type="file" name="image" value="old('image')" class="form-control" id="inputName2">
                      </div>
                      
                      @if ($errors->has('image'))
                      <span class="error">{{ $errors->first('image') }}</span>
                  @endif
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="timeline">
                  <form class="form-horizontal" id="change_password">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Current Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                      @if ($errors->has('password'))
                      <span class="error">{{ $errors->first('password') }}</span>
                  @endif
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
                      </div>
                      @if ($errors->has('new_password'))
                      <span class="error">{{ $errors->first('new_password') }}</span>
                  @endif
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                      </div>
                      @if ($errors->has('confirm_password'))
                      <span class="error">{{ $errors->first('confirm_password') }}</span>
                  @endif
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
<script>
  $(document).ready(function () {
    $('#change_password').submit(function (e) { 
      e.preventDefault();
      var passsword=$('#password').val();
      var new_password=$('#new_password').val();
      var confirm_password=$('#confirm_password').val();
      $.ajax({
        headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        type: "post",
        url: "{{ route('admin-change-password') }}",
        data: {
          'password':password,
          'new_password':new_password,
          'confirm_password':confirm_password
        },
        contentType: "application/json",
        cache: false,
        processData:false,
        success: function (response) {
          
          console.log(response.current_password);
        },
        error:function(response){

        }
      });
    });
  });
</script>
@endsection
