@extends('layout.master')


@section('content')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 ">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
              <form action="{{route('save-register-users')}}"  onsubmit="return validateForm()" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="name" name="name" class="form-control form-control-lg"  value="{{ old('name') }}"/>
                      <label class="form-label" for="firstName">Your Name</label>
                    </div>

                    @error('name')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror
                    <div style="margin: 5px;">
                        <span id="nameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" id="designation" name="designation" class="form-control form-control-lg" value="{{ old('designation') }}"/>
                      <label class="form-label" for="lastName">Your Designation</label>
                    </div>
                    <div style="margin: 5px;">
                        <span id="designationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                    @error('designation')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror

                  </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                      <div class="form-outline">
                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control form-control-lg" value="{{ old('date_of_birth') }}"/>
                        <label class="form-label" for="firstName">Date Of Birth</label>
                      </div>

                      @error('date_of_birth')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                      <div style="margin: 5px;">
                        <span id="dobError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>

                    </div>
                    <div class="col-md-6 mb-4">

                      <div class="form-outline">
                        <input type="date" id="date_of_joining" name="date_of_join" class="form-control form-control-lg" value="{{ old('date_of_join') }}"/>
                        <label class="form-label" for="lastName">Date Of Joining</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="dojError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                     </div>
                      @error('date_of_joining')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                      <div class="form-outline">
                        <select type="text" id="office" name="office_id" class="form-control form-control-lg"  value="{{ old('office_id') }}">
                          <option value="">Select Your Office</option>
                          @foreach ($offices as $office)
                             <option value="{{ $office->id }}">{{ $office->officeName }}</option>
                          @endforeach
                        </select>
                        <label class="form-label" for="firstName">Select Office Name</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="officeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>

                      @error('office_id')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <select type="text" id="district" name="district_id" class="form-control form-control-lg"  value="{{ old('district_id') }}">
                              <option value="">Select Your District</option>
                              @foreach ($districts as $district)
                                  <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                              @endforeach
                            </select>
                            <label class="form-label" for="firstName">Select District Name</label>
                        </div>

                        @error('district_id')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>  
                        </div>
                        @enderror
                        <div style="margin: 5px;">
                            <span id="districtError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                      <div class="form-outline">
                        <select type="text" id="circle" name="circle_id" class="form-control form-control-lg" value="{{ old('circle_id') }}" >
                          <option value="">Select Your Circle Area</option>

                        </select>
                        <label class="form-label" for="firstName">Select Circle Name</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="circleError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                      </div>

                      @error('circle_id')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <select type="text" id="division" name="division_id" class="form-control form-control-lg" value="{{ old('division_id') }}">
                              <option value="">Select Your Division Area</option>
                            </select>
                            <label class="form-label" for="Division">Select Division Name</label>
                        </div>
                        <div style="margin: 5px;">
                            <span id="divisionError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        @error('division_id')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">

                      <div class="form-outline">
                        <select type="text" id="range" name="range_id" class="form-control form-control-lg" >
                          <option value="">Select Your Range Area</option>
                        </select>
                        <label class="form-label" for="Range">Select Range Name</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="rangeError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                      @error('range_id')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                    <div class="col-md-6 mb-4">

                        <div class="form-outline">
                            <input type="text" id="office_address" name="office_address" class="form-control form-control-lg" value="{{ old('office_address') }}"/>
                            <label class="form-label" for="office_address">Your Office Address Name</label>
                        </div>
                        <div style="margin: 5px;">
                            <span id="addressError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                        </div>
                        @error('office_address')
                        <div class="alert alert-danger" role="alert">
                            <small>
                                <strong >{{ $message }}</strong>
                            </small>
                        </div>
                        @enderror

                    </div>
                </div>


                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <input type="text" class="form-control form-control-lg" id="qualification" name="qualification" value="{{ old('qualification') }}"/>
                      <label for="Qualification" class="form-label">Your Qualification</label>
                    </div>
                  </div>
                  @error('qualification')
                  <div class="alert alert-danger" role="alert">
                      <small>
                          <strong >{{ $message }}</strong>
                      </small>
                  </div>
                  @enderror
                  <div style="margin: 5px;">
                    <span id="qualificationError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                </div>
                <div class="form-outline">
                  <select type="text" id="gender" name="gender" class="form-control form-control-lg" value="{{ old('gender') }}">
                      <option value="" >Select</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                  </select>
                  <label class="form-label" for="firstName">Select Gender</label>
              </div>
              <div style="margin: 5px;">
                  <span id="genderError"  style="color: red; font-size:15px; font-weight:700;" ></span>
              </div>


                  @error('gender')
                  <div class="alert alert-danger" role="alert">
                      <small>
                          <strong >{{ $message }}</strong>
                      </small>
                  </div>
                  @enderror

              </div>


                  <div class="col-md-6 mb-4">

                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="text" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}"/>
                      <label class="form-label" for="emailAddress">Email</label>
                    </div>
                    <div style="margin: 5px;">
                        <span id="emailError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>

                    @error('email')
                    <div class="alert alert-danger" role="alert">
                        <small>
                            <strong >{{ $message }}</strong>
                        </small>
                    </div>
                    @enderror

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="text" id="contact" name="contact" class="form-control form-control-lg" value="{{ old('contact') }}"/>
                      <label class="form-label" for="phoneNumber">Mobile Number</label>
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

                  </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="text" id="username" name="username" class="form-control form-control-lg" value="{{ old('username') }}"/>
                        <label class="form-label" for="emailAddress">User Name</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="usernameError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                      @error('username')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                        <label class="form-label" for="phoneNumber">Password</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="passwordError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                      @error('password')
                      <div class="alert alert-danger" role="alert">
                          <small>
                              <strong >{{ $message }}</strong>
                          </small>
                      </div>
                      @enderror

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="password" id="confirm_password" name="password_confirmation" class="form-control form-control-lg" />
                        <label class="form-label" for="emailAddress">Confirm Password</label>
                      </div>
                      <div style="margin: 5px;">
                        <span id="cPasswordError"  style="color: red; font-size:15px; font-weight:700;" ></span>
                    </div>
                    </div>

                </div>


                <div class="mt-4 pt-2">
                  <input class="btn btn-success btn-lg" type="submit" value="Register" />
                </div>
                <a>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
