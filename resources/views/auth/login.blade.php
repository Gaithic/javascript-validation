@extends('layout.master')



@section('content')
<div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 ">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login Form</h3>
              <div class="row">
                    <div class="col-md-6 mb-4">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login-users') }}" onsubmit="return loginvalidateform()"  style="padding: 10px;">
                            {{ csrf_field() }}
    
                            <div class="form-outline">
                                <input type="text" id="username" name="username" class="form-control form-control-lg"  value="{{ old('username') }}"/>
                                <label class="form-label" for="firstName">User Name</label>
                            </div>
                            @error('username')
                            <div class="alert alert-danger" role="alert">
                                <small>
                                    <strong >{{ $message }}</strong>
                                </small>
                            </div>
                            @enderror
                            <div style="margin: 5px;">
                                <span id="userError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>


                            <div class="form-outline">
                                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                <label class="form-label" for="firstName">Password</label>
                            </div>

                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                <small>
                                    <strong >{{ $message }}</strong>
                                </small>
                            </div>
                            @enderror
                            <div style="margin: 5px;">
                                <span id="passwordError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                              

                            <div class="form-outline">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label class="form-label"> Remember Me
                                            <input type="checkbox" name="remember">
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
    
                                    <a class="btn btn-link" href="{{ route('forget-password')}}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection