@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/employees">See All Employees</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Employee</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Employee English</th>
                                    <td>{{ $employee->name_en }}</td>
                                </tr>
                                <tr>
                                    <th>Employee French</th>
                                    <td>{{ $employee->name_fr }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Arabic</th>
                                    <td>{{ $employee->name_ar }}</td>
                                </tr>
                                <tr>
                                    <th>Employee Status</th>
                                    <td>{{ $employee->active == 0 ? "Inactive" : "Active" }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
