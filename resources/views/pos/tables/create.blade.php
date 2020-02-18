@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create {{ $title }}</h1>
                </div>
                <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf

                                <div class="row margin-top">
                                    @error("section_id")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Table Section <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="section_id" class="form-control" id="">
                                            <option value="">Choose The Section</option>
                                            @foreach($sections as $section)
                                                <option @if(old("section_id") == $section->id) selected @endif value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

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
                                        <input size="60" maxlength="100" value="{{ $table->name ?? old("name") }}" class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <input class="btn btn-success btn-block btn-lg" id="submit-button" type="submit" name="yt0" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
