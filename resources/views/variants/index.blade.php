@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/answers/create">Create New Answer Variant</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Manage Answer Variants</h1>
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
                                        <th>Answer</th>
                                        <th>Settings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($answers as $bin => $a)
                                        <tr>
                                            <td>
                                                {{ $a->questions->question_en }}
                                            </td>
                                            <td>{{ $a->answer_en }}</td>
                                            <td class="button-column">
                                                <a rel="tooltip" data-toggle="tooltip" title="" href="/admin/answers/{{ $a->id }}/edit" data-original-title="Update">
                                                    <button class="btn btn-icon-toggle"><i class="fa fa-edit"></i></button></a>
                                                <form onsubmit="if(confirm('Do You Really Want To Delete The Answer?') == false) return false;" style="display: inline-block" action="/admin/answers/{{ $a->id }}" method="post">
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
            $.post( "/admin/answers/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
