@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/feedback/employees/create">Create New Employee</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Manage Employees</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Active</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $bin => $e)
                                        <tr>
                                            <td>{{ $e->name_en }}</td>

                                            <td>
                                                <input class="get-change-active hidden" id="get_ch_{{ $bin }}" data-id="{{ $e->id }}" @if($e->active == 1) checked="checked" @endif type="checkbox" value="{{ $e->active }}" name="active">
                                                <label for="get_ch_{{ $bin }}" class="slider-v2"></label>
                                            </td>

                                            <td class="button-column">
                                                <a rel="tooltip" data-toggle="tooltip" title="" href="/admin/feedback/employees/{{ $e->id }}" data-original-title="View">
                                                    <button class="btn btn-icon-toggle"><i class="fa fa-street-view"></i></button>
                                                </a>
                                                <a rel="tooltip" data-toggle="tooltip" title="" href="/admin/feedback/employees/{{ $e->id }}/edit" data-original-title="Update">
                                                    <button class="btn btn-icon-toggle"><i class="fa fa-edit"></i></button></a>
                                                <form onsubmit="if(confirm('Do You Really Want To Delete The Question?') == false) return false;" style="display: inline-block" action="/admin/feedback/employees/{{ $e->id }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <a rel="tooltip" data-toggle="tooltip" title="" class="delete" href="javascript:void(0)" data-original-title="Delete">
                                                        <button class="btn btn-icon-toggle"><i class="fa fa-trash"></i></button>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
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
            $.post( "/admin/feedback/employees/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
