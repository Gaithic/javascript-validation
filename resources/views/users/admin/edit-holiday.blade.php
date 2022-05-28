@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Create New/Local Holiday</h1>
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

    <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Holidays</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Holiday's</li>
            </ol>
          </div>
        </div>
 

      <div class="card card-primary my-4 p-4">
        <div class="card-header">
          <h3 class="card-title">Local Holidays</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  action="{{ route('updated-holiday', ['id' => $holidays->id]) }}"  method="post" >
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Holiday Name</label>
                        <input type="text" class="form-control" id="holiday_name" name="holiday_name" placeholder="Enter Name" value="{{ $holidays->holiday_name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Edit Date</label>
                        <input type="date" class="form-control" id="holiday_date"  name="holiday_date" value="{{ $holidays->holiday_date }}" placeholder="Select day">
                    </div>
                </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit Holiday</button>
            <button type="submit" href="{{ route('delete-holiday', ['id' => $holidays->id]) }}" class="btn btn-primary delete-confirm">Delete Holiday</button>
          </div>
        </form>
      </div>
    </div><!-- /.container-fluid -->


<script src="{{ asset('/asset/js/sweetalert/sweetalert.min.js') }}"></script>
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

@endsection

