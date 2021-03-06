@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/feedback/questions/create">Create New Question</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Manage Questions</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Feedback Answer</th>
                                        <th>Active</th>
                                        <th>Group</th>
                                        <th>Type</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($questions as $bin => $q)
                                        <tr>
                                            <td>{{ $q->question_en }}</td>
                                            <td>
                                                @if($q->type == 0)
                                                    <span style="font-size: 20px" class="label label-success">{{ $q->avgRating }}</span>
                                                    @if($q->group == 1)
                                                        <a style="text-decoration: none" href="/admin/feedback/employee-answers">
                                                            <span style="font-size: 20px" class="label label-default">See Answers</span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <input class="get-change-active hidden" id="get_ch_{{ $bin }}" data-id="{{ $q->id }}" @if($q->active == 1) checked="checked" @endif type="checkbox" value="{{ $q->active }}" name="active">
                                                <label for="get_ch_{{ $bin }}" class="slider-v2"></label>
                                            </td>
                                            <td>
                                                {{ $groups[$q->group] }}
                                            </td>
                                            <td>
                                                {{ ucfirst($types[$q->type]) }}
                                            </td>
                                            <td class="button-column">
                                                <a rel="tooltip" data-toggle="tooltip" title="" href="/admin/feedback/questions/{{ $q->id }}" data-original-title="View">
                                                    <button class="btn btn-icon-toggle"><i class="fa fa-street-view"></i></button>
                                                </a>
                                                <a rel="tooltip" data-toggle="tooltip" title="" href="/admin/feedback/questions/{{ $q->id }}/edit" data-original-title="Update">
                                                    <button class="btn btn-icon-toggle"><i class="fa fa-edit"></i></button></a>
                                                <form onsubmit="if(confirm('Do You Really Want To Delete The Question?') == false) return false;" style="display: inline-block" action="/admin/feedback/questions/{{ $q->id }}" method="post">
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
                            {{ $questions->links() }}
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
            $.post( "/admin/feedback/questions/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
