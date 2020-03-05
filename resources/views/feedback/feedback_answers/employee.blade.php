@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/feedback/answers/create">Create New Answer Variant</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Employee Answers</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Employee</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($answers as $bin => $a)
                                        <tr>
                                            <td>
                                                {{ $a->questions->question_en }}
                                            </td>
                                            <td>
                                                {{ $a->employees->name_en }}
                                            </td>
                                            <td>{{ $a->rate }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $answers->links() }}
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Employee Rates</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table2" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Rate</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employeeWithRates as $bin => $e)
                                    <tr>
                                        <td>{{ $e->name_en }}</td>
                                        <td>{{ $e->rate }}</td>
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
    <script>
        $(document).ready(function(){
            $('#table1').dataTable( {
                "paging": false
            } );
            $('#table2').dataTable( {
                "paging": false
            } );
        });
    </script>
@endsection
