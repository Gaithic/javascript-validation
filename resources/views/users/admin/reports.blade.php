@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pie Reports</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Report</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <a href="{{ route('admin-index') }}" class="btn btn-warning" style="margin-left:30px;">Back</a>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 10px;">
      <h2 class="text-center display-4">Search all Reports</h2>
    </div>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <form action="enhanced-results.html">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                      <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                                <label>User Name:</label>
                                <select class="select2" style="width: 100%;" id="userId" name="name">
                                    <option value="">Select Employee Name</option>
                                    @foreach ($users as $use)
                                          <option value="{{ $use->id }}">{{ $use->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label>Designation:</label>
                                  <select class="select2" style="width: 100%;" id="designation">
                                      <option value="">Select Designation Name</option>
                                      {{-- @foreach ($users as $use)
                                          <option value="">{{ $use->designation }}</option>
                                      @endforeach --}}
                                  </select>
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                  <label>Districts:</label>
                                  <select class="select2" style="width: 100%;" id="district" name="district_id">
                                      <option value="">Select District Name</option>
                                      {{-- @foreach ($districts as $dist)
                                          <option value="{{ $dist->id }}">{{ $dist->districtName }}</option>
                                      @endforeach --}}
                                  </select>
                              </div>
                          </div>

                          <div class="col-3">
                            <div class="form-group">
                                <label>Circles:</label>
                                <select class="select2" style="width: 100%;" id="circle" name="circle_id">
                                    <option value="">Select Circle</option>
                                    {{-- @foreach ($circles as $dist)
                                      <option value="{{ $dist->id }}">{{ $dist->circleName }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                          <div class="form-group">
                              <label>Division</label>
                              <select class="select2" style="width: 100%;" id="division" name="division_id">
                                  <option value="">Select Division Name</option>
                                  {{-- @foreach ($divisions as $dist)
                                  <option value="{{ $dist->id }}">{{ $dist->divisionName }}</option>
                              @endforeach --}}
                              </select>
                          </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                            <label>Range</label>
                            <select class="select2" style="width: 100%;" id="range" name=>
                                <option value="">Select Range</option>
                                {{-- @foreach ($ranges as $dist)
                                      <option value="{{ $dist->id }}">{{ $dist->rangesName }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-input" style="width: 100%;"/>
                        </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-input" style="width: 100%;"/>
                    </div>
                  </div>
                  
                    </div>
                     <a  class="btn btn-success" id="search">Search</a>
                  </div>
              </div>
          </form>
          <div class="row mt-3">
              <div class="col-md-10 offset-md-1">
                  <div class="list-group">
                      <div class="list-group-item">
                          <div class="row">
                              <div class="col px-4">
                                  <div>
                                      <div class="float-right"></div>
                                        <h5>Total Number Holiday</h5> 
                                        <h5>Total Number of Acitity</h5>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">Pie Chart</h3>
          
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 1000px; max-width: 100%;"></canvas>
                        </div>
                        <!-- /.card-body -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

<script src="{{ asset('/asset/admin/plugins/chart.js/Chart.min.js')}}"></script>  
<script>
  var ctx =  document.getElementById("pieChart");
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [],
      datasets: [{
        data: [],
        borderWidth: 1,
        borderColor:'#00c0ef',
        label: 'liveCount',
      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: "Employee's Chart with different Selections...",
      },
      legend: {
        display: false
      },
      options: {
          scales: {
              y: {
                  beginAtZero: false
              }
          }
      }
    }
  })

// let districts = '<?php echo json_encode($users) ?>';
// let jsonDist = JSON.parse(districts);
// // console.log(jsonDist);
// let labels=[];
// let data=[];

// for(var i=0;i<jsonDist.length;i++){
//     labels.push(jsonDist[i].districtName);
//     data.push(jsonDist[i].userCount);
// }
  
</script>


<script >
  $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $(document).ready(function () {
      $('#userId').on('change',function(e) {
          var user_id = e.target.value;
          $.ajax({
              url:"{{ route('get-fields') }}",
              data: {
                user_id: user_id
              },
              

              success:function (data) {
                  // $('#circle').empty();
                  // $.each(data.circles[0].circles,function(index,circles){
                  //     $('#circle').append('<option value="'+circles.id+'">'+circles.circleName+'</option>');
                  // })
                  $('#district').empty();
                  $.each(data.districts[0].districts, function(index, districts){
                    $('#district').append('<option value="'+district_id+'">'+district_id+'</option>')
                  })
                    
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