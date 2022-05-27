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
                                <select class="select2" style="width: 100%;" id="name" name="name">
                                    <option value="">Select Employee Name</option>
                                    @foreach ($user as $use)
                                        <option value="">{{ $use->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                          </div>

                          <div class="col-3">
                              <div class="form-group">
                                  <label>Designation:</label>
                                  <select class="select2" style="width: 100%;">
                                      <option value="">Select Designation Name</option>
                                      @foreach ($user as $use)
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
                                      @foreach ($activity as $district)
                                        <option value="{{ $district->id }}">{{ $district->districtName }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <div class="col-3">
                            <div class="form-group">
                                <label>Circles:</label>
                                <select class="select2" style="width: 100%;" id="circle" name="circle_id">
                                    <option value="">Select Circle</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                          <div class="form-group">
                              <label>Division</label>
                              <select class="select2" style="width: 100%;" id="division" name="division_id">
                                  <option value="">Select Crcle Name</option>
                              </select>
                          </div>
                      </div>

                      <div class="col-3">
                        <div class="form-group">
                            <label>Range</label>
                            <select class="select2" style="width: 100%;" id="range" name=>
                                <option value="">search by District</option>
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
    let activity = '<?php echo json_encode($activity) ?>';

    let jsonDist = JSON.parse(activity);
// console.log(jsonDist);
let labels=[];
let data=[];

for(var i=0;i<jsonDist.length;i++){
    labels.push(jsonDist[i].activityName);
    data.push(jsonDist[i].userCount);
}


console.log(labels,data);

const ctx = document.getElementById('pieChart');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels:labels,
        datasets: [{
            label: 'Total Number of Employees Registered Per District',
            data: data,
            
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
                beginAtZero: false
            }
        }
    }
});

// var pie_basic_element = document.getElementById('pieChart');
// if (pie_basic_element) {
//     var pie_basic = echarts.init(pie_basic_element);
//     pie_basic.setOption({               
        
//         textStyle: {
//             fontFamily: 'Roboto, Arial, Verdana, sans-serif',
//             fontSize: 13
//         },

//         title: {
//             text: 'Pie Chart Example',
//             left: 'center',
//             textStyle: {
//                 fontSize: 17,
//                 fontWeight: 500
//             },
//             subtextStyle: {
//                 fontSize: 12
//             }
//         },

//         tooltip: {
//             trigger: 'item',
//             backgroundColor: 'rgba(0,0,0,0.75)',
//             padding: [10, 15],
//             textStyle: {
//                 fontSize: 13,
//                 fontFamily: 'Roboto, sans-serif'
//             },
//             formatter: "{a} <br/>{b}: {c} ({d}%)"
//         },

//         legend: {
//             orient: 'horizontal',
//             bottom: '0%',
//             left: 'center',                   
//             data: ['Fruit', 'Vegitable','Grains'],
//             itemHeight: 8,
//             itemWidth: 8
//         },

//         series: [{
//             name: 'Product Type',
//             type: 'pie',
//             radius: '70%',
//             center: ['50%', '50%'],
//             itemStyle: {
//                 normal: {
//                     borderWidth: 1,
//                     borderColor: '#fff'
//                 }
//             },
//             data: [
//                data
//             ]
//         }]
//     });
// // }

</script>
@endsection