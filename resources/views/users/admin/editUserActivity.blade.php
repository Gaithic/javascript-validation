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
  <a href="{{ route('admin-index') }}" class="btn btn-warning" style="margin-left:30px;">Back</a>
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
        <form  action="{{ route('update-user-activity',  ['id' => $activities->id])}}"   method="post" onsubmit=" return activityCalender()">
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
            <a href="{{ route('delete-user-activity', ['id' => $activities->id]) }}" class="btn btn-primary delete-confirm">Delete</a>
          </div>
        </form>

    
    </section>
</div>
<script src="{{ asset('/asset/js/sweetalert/sweetalert.min.js') }}"></script>
@push('scripts')
  <script  src="{{ asset('/asset/js/calender.js') }}"></script>
  <script>
    $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      swal({
          title: 'Are you sure?',
          text: 'This record and it`s details will be permanantly deleted!',
          icon: 'warning',
          buttons: ["Cancel", "Yes!"],
      }).then(function(value) {
          if (value) {
              window.location.href = url;
          }
      });
  });
  </script>
@endpush

@endsection