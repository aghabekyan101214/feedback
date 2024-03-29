@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Update Employee</h1>
                </div>
                <form action="/admin/feedback/employees/{{ $employee->id }}" enctype="multipart/form-data" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @method("PUT")

                                <div class="row margin-top">
                                    @error("name_en")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name English <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $employee->name_en }}" class="form-control" name="name_en" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("name_fr")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name French
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $employee->name_fr }}" class="form-control" name="name_fr" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("name_am")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name Armenian
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $employee->name_am }}" class="form-control" name="name_am" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("name_ru")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name Russian
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $employee->name_ru }}" class="form-control" name="name_ru" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top ">
                                    @error("name_ar")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Name Arabic <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $employee->name_ar }}" class="form-control" name="name_ar" style="text-align: right" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top ">
                                    @error("image")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Employee Image <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("active")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Status<span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="active" class="form-control">
                                            <option @if($employee->active == 1) selected @endif value="1">Active</option>
                                            <option @if($employee->active == 0) selected @endif value="0">Inactive</option>
                                        </select>
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
