@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>{{ ucfirst(trans($action)) }} {{ $title }}</h1>
                </div>
                <form action="{{ $route . ( isset($tableSection->id) ? "/$tableSection->id" : "" )  }}" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @if(isset($tableSection))
                                    @method("PUT")
                                @endif
                                <div class="row margin-top">
                                    @error("name")
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Section Name <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="100" value="{{ $tableSection->name ?? old("name") }}" class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <input class="btn btn-success btn-block btn-lg" id="submit-button" type="submit" name="yt0" value="{{ ucfirst(trans($action)) }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
