@extends('layout.app')

@section('head')

    {{-- <meta http-equiv="refresh" content="60; url={{ route('logout') }}"> --}}

@endsection

@section('title', 'Dashboard')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h2>{{count($users)}}</h2>
                    <p>Registered Users</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-users text-white"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{count($holidays)}}</h3>

                    <p>Total Number Of local holidays in this Year</p>
                  </div>
                  <div class="icon">
                      <i class="fas fa-suitcase nav-icon text-white"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3 class="text-white">{{count($pending)}}</h3>
                    <p>count of pending employees for Approval</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-parking text-white"></i>
                  </div>
                  <a href="#" class="small-box-footer text-white"> More info <i class="fas fa-arrow-circle-right text-white"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{count($reject)}}</h3>

                    <p>count of rejected Employees account</p>
                  </div>
                  <div class="icon">
                    <i class="nav-icon fas fa-ban text-white"></i>
                  </div>
                  <a href="#" class="small-box-footer text-white"> More info <i class="fas fa-arrow-circle-right text-white"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>

    </section>

@endsection
