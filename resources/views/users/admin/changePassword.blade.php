@extends('layout.app')


@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            {{-- <li class="breadcrumb-item active"></li> --}}
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
@endsection

@section('content')
<div class="card card-info" id="forgotPassword">
    <div class="card-header">
      <h3 class="card-title">Change Password</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    
    <form class="form-horizontal" method="POST" action="{{ route('save-admin-password') }}">
        @csrf
        @foreach ($errors->all() as $error)
           <p class="text-danger">{{ $error }}</p>
        @endforeach
      <div class="card-body">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Current Password</label>
          <div class="col-sm-10">
            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
          <div class="col-sm-10">
            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
          </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
            </div>
          </div>
        </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" class="btn btn-info">Change password</button>
        <button type="button" class="btn btn-default float-right">Cancel</button>
      </div>
      <!-- /.card-footer -->
    </form>
</div>
<a type="button" href="{{ route('admin-index') }}" class="btn btn-warning m-4">Back</a>
@endsection
