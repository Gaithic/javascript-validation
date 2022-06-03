@extends('layout.app')


{{-- @section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Registered Employees Statics</h1>
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
  <a href="{{ route('admin-index') }}" class="btn btn-warning" style="margin-left:30px;">Back</a>
  <!-- /.content-header -->
@endsection --}}

@section('content')
<div class="container">
  <div class="card card-danger">
      <h2 style="text-align: center; margin:5px;">Total Number of Registered Employee's Per District</h2>
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
        <table style="padding:10px; margin:10px;">
            <tr>
                <th>Total District</th>
                <th>No of User's Registerd</th>
              </tr> 
              @foreach ($districts as $district)
                <tr>
                    <td>{{ $district->districtName }}</td>
                    <td>{{ $district->userCount }}</td>
                <tr>
              @endforeach
            
           
          </table>
          <div class="card-body">
            
              <canvas class="chart has-fixed-height" id="pie-chart"></canvas>
              <a href="{{ route('admin-index') }}" class="btn btn-warning m-2" >Back</a>
          </div>
        <!-- /.card-body -->
      </div>
</div>
<script src="{{ asset('/asset/admin/plugins/chart.js/Chart.min.js')}}"></script>
<script>

let districts = '<?php echo json_encode($districts) ?>';
let jsonDist = JSON.parse(districts);
let labels=[];
let data=[];

for(var i=0;i<jsonDist.length;i++){
    labels.push(jsonDist[i].districtName);
    data.push(jsonDist[i].userCount);
}


console.log(labels,data);

const ctx = document.getElementById('pie-chart');
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
                beginAtZero: true
            }
        }
    }
});

</script>


@endsection