@extends('layout.app')


@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Employee All Information</h1>
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
  <a href="{{ route('manage-users') }}" class="btn btn-warning" style="margin-left:30px;">Back</a>
  <!-- /.content-header -->
@endsection
@push('styles')
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
@endpush


@section('content')
<section class="content">
    <div class="container-fluid">
          <form class="row" style="padding: 10px;" action="{{ route('update-user', ['id' => $user->id])}}" method="POST" onsubmit="return createUserForm()">
            @csrf
                <div class="col-md-6">
                    <div class="card-header text-center">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card card-danger" style="padding: 10px;">
                        <div class="form-group">
                            <label>Name:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>


                        </div>
                        <!-- /.form group -->

                        <!-- Date mm/dd/yyyy -->
                        <div class="form-group">
                            <label>Designation</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-chair"></i></span>
                            </div>
                            <input type="text" class="form-control" name="designation" id="designation" value="{{$user->designation}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="designationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>

                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Date Of Birth</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{$user->date_of_birth}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="dobError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- phone mask -->
                        <div class="form-group">
                            <label>Date Of Joining</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" class="form-control"  name="date_of_join" id="date_of_joining"
                                    value="{{$user->date_of_join}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="dojError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Office</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-home"></i></span>
                            </div>
                            <select class="form-control" name="office_id" id="office" >
                                <option value="{{ $user->office->id }}">{{ $user->office->officeName }}</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->officeName }}</option>
                                @endforeach
                            </select>
                            </div>
                            <div style="margin: 5px;">
                                <span id="officeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>


                        <div class="form-group">
                            <label>Employee District</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <select class="form-control" name="district_id" value="" id="district">
                                    <option value="{{ $user->districts->id }}">{{ $user->districts->districtName }}</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                @endforeach
                            </select>
                                
                            </div>
                            <div style="margin: 5px;">
                                <span id="districtError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>


                        </div>

                        <div class="form-group">
                            <label>Employee Circle</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-circle"></i></span>
                            </div>
                            <select class="form-control"  name="circle_id" id="circle">
                                <option value="{{ $user->circles->id }}">{{ $user->circles->circleName }}</option>
                               
                            </select>
                            </div>
                            <div style="margin: 5px;">
                                <span id="circleError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Employee Division</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-divide"></i></span>
                            </div>
                            <select class="form-control" name="division_id" id="division" >
                                <option value="{{ $user->divisions->id }}">{{ $user->divisions->divisionName }}</option>
                            </select>
                                
                            </div>
                            <div style="margin: 5px;">
                                <span id="divisionError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>

                        </div>

                    </div>


                    <!-- /.card-body -->
                </div>


                <div class="col-md-6">
                    <div class="card-header text-center">
                        <h3 class="card-title"></h3>
                    </div>
                    <div class="card card-danger" style="padding: 10px;">
                        <div class="form-group">
                            <label>Employee Range:</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-road"></i></span>
                            </div>
                            <select class="form-control"  name="range_id" id="range" >
                                <option value="{{ $user->ranges->id }}">{{ $user->ranges->rangesName }}</option>
                               
                            </select>
                            </div>
                            <div style="margin: 5px;">
                                <span id="rangeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>

                        </div>

                        <div class="form-group">
                            <label>Office Address</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-book"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="office_address" id="office_address" value="{{$user->office_address}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="office_addressError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <div class="form-group">
                            <label>Employee Gender</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-male"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="gender" id="gender" value="{{$user->gender}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="genderError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Employee Qualification</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-school"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="qualification" id="qualification" value="{{$user->qualification}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="qualificationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Employee UserName</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-male"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="username" id="username" value="{{$user->username}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="usernameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Employee Email</label>

                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="email" id="email" value="{{$user->email}}">
                            </div>
                            <div style="margin: 5px;">
                                <span id="emailError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Update Password</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    
                                </div>
                                <input type="password" class="form-control"
                                    name="password" id="updatepassword" >                                    
                            </div>
                            <input type="checkbox" onclick="showPassword()" style="padding: 10px;"> Show Password
                            <div style="margin: 5px;">
                                <span id="updateError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>


                            <!-- /.input group -->
                        </div>
                        
                        <div class="form-group">
                            <label>Employee Contact</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control"
                                    name="contact" id="contact" value="{{$user->contact}}">
                            </div>


                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Employee Status</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-running"></i></span>
                                    <select  name="status" id="status">
                                        <option value="{{$user->status}}" style="color: black;  font-weight:900;">
                                            @if ($user->status)
                                                Approved
                                            @else
                                                Not Approved
                                            @endif
                                        </option>
                                        <option value="1" style="color: green;  font-weight:900;">Approve</option>
                                        <option value="0" style="color: red; font-weight:900;">Reject</option>

                                    </select>
                                </div>
                            </div>
                            <br>


                            <!-- /.input group -->
                        </div>

                    </div>


                    <!-- /.card-body -->
                </div>
            

                <div class="form-submit">
                    <input type="submit" value="Update" class="btn btn-success" id="submit" name="submit" class="submit"/>               
                    <a href="{{ route('delete-user', ['id' => $user->id]) }}" class="button delete-confirm">Delete</a>
                </div>
            </form>
    
    </div>
</section>
@push('scripts')
    <script src="{{ asset('/asset/js/admin/createUserFormValidate.js') }}"></script>
@endpush
<script src="{{ asset('/asset/js/sweetalert/sweetalert.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
   function showPassword(){
       var showPassword = document.getElementById('updatepassword');
        if (showPassword.type === "password") {
            showPassword.type = "text";
        } else {
            showPassword.type = "password";
        }
   }
</script>
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
<script>
   const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function () {

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            

            this.classList.toggle("fa-lock");
        });


        const form = document.querySelector("form");
        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });
</script>

<script >
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('#district').on('change',function(e) {
            var dist_id = e.target.value;
            $.ajax({
                url:"{{ route('ajax-circle') }}",
                data: {
                    dist_id: dist_id
                },
                success:function (data) {
                    $('#circle').empty();
                    $.each(data.circles[0].circles,function(index,circles){
                        $('#circle').append('<option value="'+circles.id+'">'+circles.circleName+'</option>');
                    })

                    $('#division').empty();
                        $.each(data.divisions[0].divisions, function(index, divisions){
                        $('#division').append('<option value="'+divisions.id+'">'+divisions.divisionName+'</option>');
                    })
                    $('#range').empty();
                    $.each(data.ranges[0].ranges, function(index, ranges){
                        $('#range').append('<option value="'+ranges.id+'">'+ranges.rangesName+'</option>');
                    })

                    $(document).ready(function (){
                        $('#division').on('change', function(e){
                            var id = e.target.value;
                            $.ajax({
                                url:"{{ route('ajax-ranges') }}",
                                data:{
                                    id: id
                                },
                                success:function(data){
                                    $('#range').empty();
                                    $.each(data.ranges[0].ranges, function(index, ranges){
                                        $('#range').append('<option value="'+ranges.id+'">'+ranges.rangesName+'</option>');
                                    })
                                }
                            })
                        })
                    })
                }
            })
        });
    });
</script>

@endsection
