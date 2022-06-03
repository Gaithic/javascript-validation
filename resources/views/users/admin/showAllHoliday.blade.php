@extends('layout.app')

@section('breadcrumbs')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">All Holiday's</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">Holiday's</li>
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
                            <th>Name</th>
                            <th>Date of Holiday	</th>
                            <th>Holiday Creation Date</th>
                            <th>Holiday Updated Date</th>
                            <th>Action</th>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            var table = $('#data-table').DataTable({
                processing: true,
                serverside: true,
                bDestroy: true,
                ajax: "{{ route('manage-holidays') }}",
                columns: [
                    {data: 'holiday_name', name: 'holiday_name'},
                    {data: 'holiday_date', name: 'holiday_date'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
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
