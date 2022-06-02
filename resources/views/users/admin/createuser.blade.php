@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Add New Employee</h1>
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
<section class="content">
    <div class="container-fluid">
          <form class="row" style="padding: 10px;" action="{{ route('save-user') }}" method="POST" onsubmit="return createUserForm()">
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
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" >
                        </div>
                        <div style="margin: 5px;">
                            <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('name')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror


                    </div>

                    <div class="form-group">
                        <label>Designation</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-chair"></i></span>
                        </div>
                        <input type="text" class="form-control" name="designation"  id="designation" value="{{old('designation')}}">
                        </div>
                        <div style="margin: 5px;">
                            <span id="designationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                    </div>
                    @error('designation')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror

                    <div class="form-group">
                        <label>Date Of Birth</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" id="date_of_birth" value="{{old('date_of_birth')}}">
                        </div>
                        <div style="margin: 5px;">
                            <span id="dobError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('date_of_birth')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Date Of Joining</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" name="date_of_join" id="date_of_joining"
                                value="{{old('date_of_joining')}}">
                        </div>
                        <!-- /.input group -->
                        <div style="margin: 5px;">
                            <span id="dojError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('date_of_join')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>Office</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-home"></i></span>
                        </div>
                        <select class="form-control" name="office_id" id="office" >
                            <option value="">Select</option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->officeName }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div style="margin: 5px;">
                            <span id="officeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('office')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                    </div>


                    <div class="form-group">
                        <label>Employee District</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
                            </div>
                            <select style="padding: 5px;" name="district_id" id="district">
                                <option value="">Map District For Employee</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div style="margin: 5px;">
                            <span id="districtError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('district')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror


                    </div>

                    <div class="form-group">
                        <label>Employee Circle</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-circle"></i></span>
                        </div>
                            <select style="padding: 5px;" name="circle_id" id="circle">
                                <option value="">Map Circle For Employee</option>
                            </select>
                        </div>
                        <div style="margin: 5px;">
                            <span id="circleError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                    </div>

                    @error('circle')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror

                    <div class="form-group">
                        <label>Employee Division</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-divide"></i></span>
                        </div>
                            <select style="padding: 5px;" name="division_id" id="division">
                                <option value="">Map Division For Employee</option>
                            </select>
                        </div>
                        <div style="margin: 5px;">
                            <span id="divisionError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                    </div>

                    @error('division')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror


                    <div class="form-group">
                        <label>Employee Range:</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-road"></i></span>
                        </div>

                        <select style="padding: 5px;" name="range_id" id="range">
                            <option value="">Map Range For Employee</option>
                        </select>
                        </div>

                        <div style="margin: 5px;">
                            <span id="rangeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                    </div>


                    @error('range')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror

                </div>


                <!-- /.card-body -->
            </div>



            <div class="col-md-6">
                <div class="card-header text-center">
                    <h3 class="card-title"></h3>
                </div>

                <div class="card card-danger" style="padding: 10px;">



                    <div class="form-group">
                        <label>Office Address</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-book"></i></span>
                        </div>
                        <input type="text" class="form-control"
                            name="office_address" id="office_address" value="{{old('office_address')}}">
                        </div>
                        <!-- /.input group -->
                        <div style="margin: 5px;">
                            <span id="office_addressError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        @error('office_address')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Gender</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                            <select name="gender" id="gender" value="{{old('gender')}}" style="padding: 5px;">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>

                            <div style="margin: 5px;">
                                <span id="genderError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                        </div>
                        <!-- /.input group -->
                        @error('gender')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Qualification</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-school"></i></span>
                        </div>
                        <input type="text" class="form-control"
                            name="qualification"  id="qualification" value="{{old('qualification')}}">
                        </div>
                        <!-- /.input group -->


                        <div style="margin: 5px;">
                            <span id="qualificationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('qualification')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee UserName</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-male"></i></span>
                        </div>
                        <input type="text" class="form-control"
                            name="username" id="username" value="{{old('username')}}">
                        </div>

                        <div style="margin: 5px;">
                            <span id="usernameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        <!-- /.input group -->
                        @error('username')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Email</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control"
                            name="email" id="email" value="{{old('email')}}">
                        </div>

                        <div style="margin: 5px;">
                            <span id="emailError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        <!-- /.input group -->
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Password</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control"
                            name="password"  id="password">
                        </div>

                        <div style="margin: 5px;">
                            <span id="passwordError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        <!-- /.input group -->
                        @error('password')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>

                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control"
                            name="password_confirmation"  id="confirm_password">
                        </div>

                        <div style="margin: 5px;">
                            <span id="confirmError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        <!-- /.input group -->
                        @error('password_confirmation')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Contact</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control"
                                name="contact" id="contact" value="{{old('contact')}}">
                        </div>


                        <div style="margin: 5px;">
                            <span id="contactError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>

                        @error('contact')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                        <!-- /.input group -->
                    </div>

                    <div class="form-group">
                        <label>Employee Status</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-running"></i></span>
                                <select  name="status"  id="status" style="padding: 5px;">
                                    <option value="" style="color: black;  font-weight:900;">Select Status</option>
                                    <option value="1" style="color: green;  font-weight:900;">Approve</option>
                                    <option value="0" style="color: red; font-weight:900;">Reject</option>

                                </select>

                            </div>
                            <div style="margin: 5px;">
                                <span id="statusError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                        </div>
                        @error('status')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Employee Role</label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-running"></i></span>
                                <select  name="isAdmin" id="isadmin" style="padding: 5px;">
                                    <option value="" style="color: black;  font-weight:900;">Select Role</option>
                                    <option value="1" style="color: green;  font-weight:900;">Admin</option>
                                    <option value="0" style="color: red; font-weight:900;">Employee</option>

                                </select>

                            </div>

                            <div style="margin: 5px;">
                                <span id="isadminError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                            </div>
                            @error('isAdmin')
                            <div class="alert alert-danger" role="alert">
                                <small>
                                    <strong >{{ $message }}</strong>
                                </small>
                            </div>
                            @enderror
                        </div>
                    </div>


                </div>


                <!-- /.card-body -->
            </div>


                <div class="form-submit">
                    <input type="submit" value="Create" class="btn btn-success" id="submit" name="submit" />
                    <button type="submit" value="Cancel" class="btn btn-danger" id="reset" name="reset" >Cancel</button>
                </div>
            </form>
    </div>

</section>

@push('scripts')
    <script src="{{ asset('/asset/js/admin/createUserFormValidate.js') }}"></script>    
@endpush

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
                url:"{{ route('admin-ajax-circle') }}",
                // type:"POST",
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
                                url:"{{ route('admin-ajax-ranges') }}",
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
