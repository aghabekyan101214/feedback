@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="col-md-6">
                        <h1>Active Fields</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Status</th>
                                        <th>Required</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fields as $bin => $q)
                                        <tr>
                                            <td>{{ $q->field_name }}</td>
                                            <td>
                                                <input class="get-change-active hidden" id="get_ch_{{ $bin }}" data-id="{{ $q->id }}" @if($q->active == 1) checked="checked" @endif type="checkbox" value="{{ $q->active }}" name="active">
                                                <label for="get_ch_{{ $bin }}" class="slider-v2"></label>
                                            </td>
                                            <td>
                                                {{ $q->required == 0 ? "Optional" : "Required" }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $fields->links() }}
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
            $.post( "/admin/feedback/active-fields/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
