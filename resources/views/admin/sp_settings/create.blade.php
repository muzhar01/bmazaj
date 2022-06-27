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
                        <li class="breadcrumb-item active">Add Service Provider</li>
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
                    <form action="{{ route('sp-settings.store') }}" method="post">
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
                                        <input id="link" type="text" name="link" class="form-control" placeholder="Service Provider Link" value="{{ old('link') ?? 'https://randomuser.me/api/' }}">
                                        @if ($errors->has('link'))
                                            <span class="error">{{ $errors->first('link') }}</span>
                                        @endif
                                    </div>
                                    
                                </div>

                                <div class="row mb-3">
                                    <!-- Admin Email -->
                                    <div class="col-6">
                                        <label for="email">Email/Username</label>
                                        <input id="email" type="text" name="email" class="form-control" placeholder="Enter Registered Email" value="{{ old('email') ?? '' }}">
                                        @if ($errors->has('email'))
                                            <span class="error">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-6">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" name="password" class="form-control" placeholder="Enter Password" autocomplete="off">
                                        @if ($errors->has('password'))
                                            <span class="error">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Fetch button -->
                                    <div class="col-6">
                                        <button id="fetch-token" class="btn btn-secondary" type="button" onclick="fetchToken();">Fetch Token Now</button>
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
                                </div>

                                <div class="row">
                                        <div class="col-auto">
                                          <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  name="remember_me" id="remember_me" checked="true">
                                                <label class="form-check-label" for="remember_me">
                                                   Use this Token for long time
                                                </label>
                                            </div>
                                        </div>

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

    <script>

        function fetchToken(){
            let emailEl = $('input[name="email"]');
            let passwordEl = $('input[name="password"]');
            let linkEl = $('input[name="link"]');
            let remember_me = $('input[name="remember_me"]').is(":checked");

            let email = emailEl.val();
            let password = passwordEl.val();
            let link = linkEl.val();

            if(!email){
                emailEl.addClass('border-danger');
            }else{
                emailEl.removeClass('border-danger');
                emailEl.addClass('border-success');

            }

            if(!password){
                passwordEl.addClass('border-danger');
            }else{
                passwordEl.removeClass('border-danger');
                passwordEl.addClass('border-success');
            }

            if(!link){
                linkEl.addClass('border-danger');
            }else{
                linkEl.removeClass('border-danger');
                linkEl.addClass('border-success');
            }

            if(!email || !password || !link){
                return 0;
            }

            if(confirm('Are You Sure to get the token')){
                console.log('email ::: ', email);
                console.log('password ::: ', password);
                console.log('link ::: ', link);

                 $.ajax({
                    type: "GET", //Todo: change to POST
                    url: link + '',
                    data: {
                        "username":email,
                        "password":password,
                        "remember_me":remember_me ? true:false
                    },
                    success: function (response) {
                        console.log("server response :: ", response);

                        let token = response.results[0].login.sha256; //Todo delete this
                        //let token = response.token;
                        if(token){
                            $('input[name="token"]').val(token);
                            $('input[name="token"]').addClass('border-success');

                        }else{
                            $('#fetch-token').addClass('border-danger');

                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    }
                
                });

            }
        }

    </script>
@endsection
