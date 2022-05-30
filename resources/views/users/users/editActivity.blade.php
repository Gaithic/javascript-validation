@extends('layout.master')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Activity</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Activity</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
@endsection

@push('styles')
    <link href="{{asset('/asset/css/user.css') }}" rel="stylesheet">
@endpush

@section('content')
<section class="vh-100">
   <form action="{{ route('update-activity', ['id' => $activity->id]) }}" method="POST" onsubmit=" return activityCalender()">
    @csrf
    <div class="container py-5 h-100">
      <div class="h1 text-center mt-3 mb-4 pb-3 text-center">
        <a style="color: black; float:left; margin:5px; padding:10px;" class="heading"></a>
      </div>
      <div class="h1 text-center mt-3 mb-4 pb-3 text-center">
        <a href="#" style="color: black; float:right; margin:5px; padding:10px;" class="heading"></a>
      </div>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2; padding:10px;">
            <div class="card-body py-4 px-4 px-md-5" style="padding:10px; margin:10px;">


              <p class="h1 text-center mt-3 mb-4 pb-3 text-center">

                <u style="color: black;" class="heading">Daily Diary Page</u>
              </p>

              <p class="h1 text-center mt-3 mb-4 pb-3 text-center">

                <u style="color: black;" class="heading"></u>
              </p>

              <div class="pb-2" style="padding:10px; margin:5px;">
                <div class="card">
                  <div class="card-body">
                    <label style="padding:10px;">Name:</label>
                    <div class="d-flex flex-row align-items-center" style="padding:10px;">
                     <input type="text" placeholder="Add Activity name" name="name" id="name"
                     class="form-control" value="{{ $activity->name }}" />
                      <span id="nameError" style="color: red;"></span>
                      <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></a>
                      <div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @error('name')
              <div class="alert alert-danger" role="alert">
                  <small>
                      <strong>{{ $message }}</strong>
                  </small>
              </div>
              @enderror

              <div class="pb-2" style="padding:10px; margin:5px;">
                <div class="card">
                  <div class="card-body" >
                    <label style="padding:10px;" >Date:</label>
                    <div class="d-flex flex-row align-items-center">
                       <input name="datetime" id="datetime"
                     class="form-control" value="{{  $activity->datetime}} " />

                     <span id='dateError' style="color: red;"></span>
                      <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></a>
                      <div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @error('datetime')
              <div class="alert alert-danger" role="alert">
                  <small>
                      <strong>{{ $message }}</strong>
                  </small>
              </div>
              @enderror

              <div class="pb-2" style="padding:10px; margin:5px;">
                <div class="card">
                  <div class="card-body">
                    <label style="padding:10px;" >Activity:</label>
                    <div class="d-flex flex-row align-items-center">
                      <select name="activityName" id="activity" class="form-control">
                        <option value="{{ $activity->activityName }}">{{ $activity->activityName }}</option>
                        <option value="office">Office</option>
                        <option value="field visit">Field visit</option>
                        <option value="tour">Tour</option>
                        <option value="meeting">Meeting</option>
                        <option value="leave">Leave</option>
                     </select>
                     <span id="activityError" style="color: red;"></span>
                      <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></i></a>
                      <div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @error('activity_list')
              <div class="alert alert-danger" role="alert">
                  <small>
                      <strong>{{ $message }}</strong>
                  </small>
              </div>
              @enderror


              <div class="pb-2" style="padding:10px; margin:5px;">
                <div class="card">
                  <div class="card-body">
                    <label style="padding:10px;" >Description:</label>
                    <div class="d-flex flex-row align-items-center">
                        <textarea type="text" class="ckeditor form-control" id="description" name="description" placeholder="Enter Message Here">{{ $activity->description }}</textarea>  
                        <span id="desciptionError" style="color: red;"></span>
                      <a href="#!" data-mdb-toggle="tooltip" title="Set due date"></i></a>
                    </div>
                    <div style="padding:10px; margin:5px;">
                      <input type="submit" class="btn btn-warning" value="Update Activity" style="font-weight:700; font-size:20px; background: #23af89;"/>
                    </div>
                  </div>
                </div>
              </div>
              @error('description')
              <div class="alert alert-danger" role="alert">
                  <small>
                      <strong>{{ $message }}</strong>
                  </small>
              </div>
              @enderror






            </div>
          </div>
        </div>
      </div>
    </div>
   </form>
  </section>
  <script  src="{{ asset('/asset/js/calender.js') }}"></script>
  <script>
    var date = document.getElementById('datetime');
    date.addEventListener('click', function(){
      date.type =  "date"
    })
  </script>
@endsection
