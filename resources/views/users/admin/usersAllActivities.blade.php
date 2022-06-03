@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All users activities</h1>
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

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                All Users
            </div>
            <div class="card-body table-responsive table-striped table-bordered">

                <table class="table" id="data-table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Activity Name</th>
                            <th>Activity Descrption</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('admin-index') }}" class="btn btn-warning m-2">Back</a>
</section>

@push('scripts')
    <script>
        $(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverside: true,
                bDestroy: true,
                ajax: "{{ route('show-user-activity') }}",
                columns: [
                    {data: 'user_id', name: 'user_id'},
                    {data: 'name', name: 'name'},
                    {data: 'activityName', name: 'activityName'},
                    

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    }
                ]

            });
        });
    </script>
@endpush


@endsection

