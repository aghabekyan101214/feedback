@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="list-group pull-right inline-style" id="yw0">
                    <li class="list-group-item"><a href="/admin/images/create">Add Image</a></li>
                </ul>
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
                        @foreach($images as $i)
                            <div class="col-sm-6 col-md-3" id="for-remove-{{ $i->id }}">
                                <div class="thumbnail">
                                    <img class="cursor-zoom-in" src="{{ url("/storage/$i->image") }}">

                                    <div class="caption">
                                        <p style="text-align: center">
                                            <button class="btn btn-danger  delete-image" data-id="{{ $i->id }}">
                                                Delete
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $images->links() }}
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
            $.post( "/admin/active-fields/change-status", {id: id, status: status}, function( data ) {

            });
        });
    </script>
@endsection
