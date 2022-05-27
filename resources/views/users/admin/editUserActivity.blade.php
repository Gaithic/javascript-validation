@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User Activity Detail</h1>
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
    <section class="content-header">
      <div class="container-fluid">
      <div class="card card-primary my-4 p-4">
        <div class="card-header">
          <h3 class="card-title">Activity Detail</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  action="{{ route('update-activity',  ['id' => Auth::user()->id])}}"   method="post" onsubmit="return editActivityValidation()">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $activities->name}}">
                    </div>
                    <div style="margin: 5px;">
                      <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                  </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" value="{{ $activities->description}}">
                    </div>

                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity Purpose</label>
                        <input type="text" class="form-control" id="activityName" name="activityName" placeholder="Enter Description" value="{{ $activities->activityName}}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Activity Date</label>
                        <input type="text" class="form-control" id="datetime" name="datetime" placeholder="Enter Description" value="{{$activities->datetime }}">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Created On</label>
                        <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Enter Description" value="{{ $activities->created_at }}">
                    </div>

                </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Activity</button>
          </div>
        </form>

    
    </section>
</div>

@endsection