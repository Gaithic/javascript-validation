@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
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
                                          <option value="">{{ $use->name }}</option>
                                      @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label>Designation:</label>
                                  <select class="select2" style="width: 100%;" id="designation">
                                      <option value="">Select Designation Name</option>
                                      @foreach ($users as $use)
                                          <option value="">{{ $use->designation }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                  <label>Districts:</label>
                                  <select class="select2" style="width: 100%;" id="district" name="district_id">
                                      <option value="">Select District Name</option>
                                      @foreach ($districts as $dist)
                                          <option value="{{ $dist->id }}">{{ $dist->districtName }}</option>
                                      @endforeach
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
var ctx_live = document.getElementById("pieChart");

let labels = [];
let data  = [];
let activity = [];
var myChart = new Chart(ctx_live, {
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
});

// logic to get new data
var getData = function() {
    let disrtict = '<?php echo json_encode($districts)?>';
    let jsonDist = JSON.parse(disrtict);
    var e = document.getElementById("district");
    var strUser = e.value;
      $.ajax({
        url: '',
        success: function(data) {
          for(var i=0;i<jsonDist.length;i++){
            // myChart.labels.push(jsonDist[i].districtName);
              myChart.data.labels.push(jsonDist[i].districtName);
              myChart.data.datasets[0].data.push(jsonDist[i].userCount);
          }
          myChart.update();
        }
      });
};






const district = document.getElementById('district');
district.addEventListener('change', getData);


</script>


@endsection