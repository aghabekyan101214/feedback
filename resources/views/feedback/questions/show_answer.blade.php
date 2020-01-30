@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
{{--                    <li class="list-group-item"><a href="/admin/questions/create">Create New Question</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-12">
                        <h1>Answers Of The Question " {{ $data->question_en }} "</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>Client</th>
                                    <th>Employee</th>
                                    <th>Rating</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->clients_answers as $bin => $q)
                                    <tr>
                                        <td>{{ $q->clients->name }}</td>
                                        <td>{{ $q->employee->name_en ?? "" }}</td>
                                        <td>
                                            <span class="label font20 label-lg label-success">{{ $q->rate ?? "" }}</span>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
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
