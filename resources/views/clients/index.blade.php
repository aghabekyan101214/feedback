@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
{{--                    <li class="list-group-item"><a href="/admin/employees/create">Create New Employee</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Manage Clients</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $bin => $e)
                                        <tr>
                                            <td>{{ $e->name }}</td>
                                            <td>{{ $e->email }}</td>
                                            <td>{{ $e->phone }}</td>
                                            <td>{{ $e->age }}</td>
                                            <td>{{ $e->gender }}</td>
                                            <td>{{ $e->comment }}</td>
                                            <td>{{ $e->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('change', '.get-change-active', function () {
            var id = $(this).attr('data-id');
            var status = $(this).is(':checked') ? 1 : 0;
            $.post( "/admin/employees/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
