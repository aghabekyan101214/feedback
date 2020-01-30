@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/feedback/questions">See All Questions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Question</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Question English</th>
                                    <td>{{ $question->question_en }}</td>
                                </tr>
                                <tr>
                                    <th>Question French</th>
                                    <td>{{ $question->question_fr }}</td>
                                </tr>
                                <tr>
                                    <th>Question Arabic</th>
                                    <td>{{ $question->question_ar }}</td>
                                </tr>
                                <tr>
                                    <th>Average Rating</th>
                                    <td>4.80</td>
                                </tr>
                                <tr>
                                    <th>Active</th>
                                    <td>{{ $question->active }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $question->type == 0 ? 'General Ratiing' : ($question->type == 1 ? 'Employee Rating' : 'Custom') }}</td>
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
