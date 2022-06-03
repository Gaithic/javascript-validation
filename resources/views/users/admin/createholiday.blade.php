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
    <section class="content-header">
      <div class="card card-primary my-4 p-4">
        <div class="card-header">
          <h3 class="card-title">Local Holidays</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  action="{{ route('save-holiday') }}"  method="post"  onsubmit="return holidayFormValidation()">
            @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Holiday Name</label>
                        <input type="text" class="form-control" id="holiday_name" name="holiday_name" placeholder="Enter Name">
                      </div>
                        <div style="margin: 5px;">
                          <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                      </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Choose Date</label>
                        <input type="date" class="form-control" id="holiday_date"  name="holiday_date" placeholder="Select day">
                    </div>
                    <div style="margin: 5px;">
                      <span id="dateError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                  </div>
                </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Holiday</button>
          </div>
        </form>

    
      </div>
      <a href="{{ route('admin-index') }}" class="btn btn-warning">Back</a>
    </section>
    @push('scripts')
          <script src="{{ asset('asset/js/admin/createholiday.js') }}"></script>
    @endpush
@endsection