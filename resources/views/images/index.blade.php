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
                                    <img class="cursor-zoom-in" src="{{ url("/uploads/$i->image") }}">

                                    <div class="caption">
                                        <p style="text-align: center">
                                            <button class="btn btn-danger  delete-image" onclick="del({{ $i->id }})">
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
        function del(id) {
            $.post( "/admin/images/" + id, {_method: "DELETE"}, function( data ) {
                $( "#for-remove-" + id ).remove();
            });
        }
    </script>
@endsection
