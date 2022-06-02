@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create New Activity</h1>
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
  <a href="{{ route('admin-index') }}" class="btn btn-warning" style="margin-left:30px;">Back</a>
  <!-- /.content-header -->
@endsection

@section('content')
    <section class="content-header">
      <div class="card card-primary my-4 p-4">
        <div class="card-header">
          <h3 class="card-title">Create New Activity</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  action="{{ route('update-acivity', ['id' => $activitylist->id]) }}"  method="post"  onsubmit="return activityFormValidation()">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $activitylist->name }}">
                      </div>
                        <div style="margin: 5px;">
                          <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                      </div>
                    </div>
                </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Activity List For Employees</button>
          </div>
        </form>
  </div>
   
    </section>
    @push('scripts')
          <script src="{{ asset('asset/js/admin/createholiday.js') }}"></script>
    @endpush  

@endsection
