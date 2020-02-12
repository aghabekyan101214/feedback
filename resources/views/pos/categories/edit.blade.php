@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Edit {{ $title }}</h1>
                </div>
                <form action="{{ $route."/".$category->id }}" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @method("PUT")
                                <div class="row margin-top">
                                    @error("name")
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Category Name <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="100" value="{{ $category->name ?? old("name") }}" class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("icon")
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Icon
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" name="icon" class="form-control">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    <div class="col-md-12 text-center">
                                        <img style="height: 150px; display: inline-block" src="{{ asset("uploads/$category->icon") }}" class="img-responsive" alt="">
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <input class="btn btn-success btn-block btn-lg" id="submit-button" type="submit" name="yt0" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
