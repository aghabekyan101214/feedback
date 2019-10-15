@extends("layouts.app")
@section("content")
    <style>
        .dropzone{
            border-style: dashed;
            border-width: 1px;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create Question</h1>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Dropzone </h3>
                            <p class="text-muted m-b-30"> For multiple file upload</p>
                            <form action="/admin/images" class="dropzone" method="post">
                                @csrf
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
