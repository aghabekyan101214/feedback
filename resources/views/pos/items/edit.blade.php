@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create {{ $title }}</h1>
                </div>
                <form action="{{ $route."/".$item->id }}" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @method("PUT")

                                <div class="row margin-top">
                                    @error("category_id")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Select Category <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="category_id" class="form-control select2" required id="">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $c)
                                                <option @if($item->categories->id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
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
                                        <label class="required">Item Name <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="100" value="{{ $item->name ?? old("name") }}" class="form-control" name="name" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("price")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Item Price <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input step="any" value="{{ $item->price ?? old("price") }}" class="form-control" name="price" type="number">
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
                                        <img style="height: 150px; display: inline-block" src="{{ asset("uploads/$item->icon") }}" alt="">
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
