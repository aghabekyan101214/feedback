@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="{{ $route }}/create">Create New {{ $title }}</a></li>
                </ul>
            </div>
        </div>
    </div>
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
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Icon</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $bin => $d)
                                    <tr>
                                        <td>{{ $bin + 1 }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td><img class="img-responsive" style="height: 100px" src="{{ asset("uploads/$d->icon") }}" alt=""></td>
                                        <td>
                                            <a rel="tooltip" data-toggle="tooltip" title="" href="{{ $route."/".$d->id }}" data-original-title="View">
                                                <button class="btn btn-icon-toggle"><i class="fa fa-street-view"></i></button>
                                            </a>
                                            <a rel="tooltip" data-toggle="tooltip" title="" href="{{ $route."/".$d->id }}/edit" data-original-title="Update">
                                                <button class="btn btn-icon-toggle"><i class="fa fa-edit"></i></button></a>
                                            <form onsubmit="if(confirm('Do You Really Want To Delete The Question?') == false) return false;" style="display: inline-block" action="{{ $route."/".$d->id }}" method="post">
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
