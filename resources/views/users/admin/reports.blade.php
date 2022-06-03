@extends('layout.app')

{{-- @section('breadcrumbs')
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
@endsection --}}

@section('content')
    <div class="container-fluid" style="padding: 10px;">
      <h2 class="text-center display-4">Search all Reports</h2>
    </div>

  <!-- Main content -->
  <section>
      <div class="container-fluid" class="input-daterange">
          <form action="enhanced-results.html">
              <div class="row">
                  <div class="col-md-10 offset-md-1">
                      <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                                <label>User Name:</label>
                                <select class="select" style="width: 100%;" id="userId" name="name">
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
                                  <select class="select" style="width: 100%;" id="designation">
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
                                  <select class="select" style="width: 100%;" id="district" name="district_id">
                                      <option value="">Select District Name</option>
                                      @foreach ($districts as $dist)
                                          <option value="{{ $dist->id }}" id="show">{{ $dist->districtName }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="col-3">
                            <div class="form-group">
                                <label>Circles:</label>
                                <select class="select" style="width: 100%;" id="circle" name="circle_id">
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
                              <select class="select" style="width: 100%;" id="division" name="division_id">
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
                            <select class="select" style="width: 100%;" id="range" name=>
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
                            <input type="date" class="form-input" style="width: 100%;" name="start_date" id="from_date"/>
                        </div>
                    </div>

                    <div class="col-3">
                      <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-input" style="width: 100%;" name="end_date" id="to_date"/>
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
                                        {{-- <h5>Total Number Holiday</h5> 
                                        <h5>Total Number of Acitity</h5> --}}
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
                          <a href="{{ route('admin-index') }}" class="btn btn-warning m-2">Back</a>
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
 
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
     const userId = document.getElementById('userId');
     userId.addEventListener('change', function(e){
          var user_id = e.target.value;
          $.ajax({
              url:"{{ route('get-fields') }}",
              data: {
                  user_id: user_id
              },
              success:function(data){
                
                $('#designation').empty();
                $('#designation').append('<option value="'+data.district[0].id+'">'+data.district[0].designation+'</option>');
                $('#district').empty();
                $('#district').append('<option value="'+data.district[0].districts.id+'">'+data.district[0].districts.districtName+'</option>');
                $('#circle').empty();
                $('#circle').append('<option value="'+data.district[0].circles.id+'">'+data.district[0].circles.circleName+'</option>');
                $('#division').empty();
                $('#division').append('<option value="'+data.district[0].divisions.id+'">'+data.district[0].divisions.divisionName+'</option>');
                $('#range').empty();
                $('#range').append('<option value="'+data.district[0].ranges.id+'">'+data.district[0].ranges.rangesName+'</option>');
                    const chart = document.getElementById('userId');
                    let users = '<?php echo json_encode($users) ?>';
                    // let jsonDist = JSON.parse(data);
                    let jsonDist = data;
                    let labels=[];
                    let data2=[];
                    
                    for(var i=0;i<jsonDist.district[0].activities.length;i++){
                      labels.push(jsonDist.district[0].activities[i].created_at);
                      data2.push(jsonDist.activityCount);
                    }

                    console.log('data2',data2);

                    const ctx = document.getElementById('pieChart');
                    const myChart = new Chart(ctx, {
                      type: 'pie',
                      data: {
                          labels:labels,
                          datasets: [{
                              label: 'Total Number of Activity',
                              data: data2,
                              
                              backgroundColor: [
                                  'rgba(255, 99, 132, 0.2)',
                                  'rgba(54, 162, 235, 0.2)',
                                  'rgba(255, 206, 86, 0.2)',
                                  'rgba(75, 192, 192, 0.2)',
                                  'rgba(153, 102, 255, 0.2)',
                                  'rgba(255, 159, 64, 0.2)'
                              ],
                              borderColor: [
                                  'rgba(255, 99, 132, 1)',
                                  'rgba(54, 162, 235, 1)',
                                  'rgba(255, 206, 86, 1)',
                                  'rgba(75, 192, 192, 1)',
                                  'rgba(153, 102, 255, 1)',
                                  'rgba(255, 159, 64, 1)'
                              ],
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              y: {
                                  beginAtZero: true
                              }
                          }
                      }
                    });                    
                }
            })
        })
    });
</script>
<script>
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
                }
            })
        });
    
    var users = '<?php echo json_encode($users) ?>';
    $('#to_date').on('change', function(e){
        if($('#from_date').val() && $('#to_date').val() ) {
            var start_date =$('#from_date').val();
            var end_date = $('#to_date').val();
            var dist_id = $('#district').val();
            $.ajax({
                url:"{{ route('get-fields') }}",
                data:{
                    start_date: start_date,
                    end_date: end_date,
                    dist_id : dist_id

                },
                success:function(data){
                    console.log(data);
                    let jsonDist = data;
                    labels=[];
                    data=[];

                    for(var i=0;i<jsonDist.activityCount.date.length;i++){
                        console.log(jsonDist.activityCount.date[i].created_at);
                        labels.push(jsonDist.activityCount.date[i].created_at);
                        data.push(jsonDist.activityCount.date[i].activityCount);
                    }       
            
                    // console.log(labels);
                    const ctx = document.getElementById('pieChart');
                    const myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels:labels,
                            datasets: [{
                                label: 'Total Number of Activity',
                                data:   data,
                                
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                                
                }
            })
        }else {
            alert('Please select dates.');
        }
        
    })   
});
</script>


    
   


@endsection