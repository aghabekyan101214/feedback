@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create Question</h1>
                </div>
                <form action="/admin/questions" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                    @csrf
                                    <div class="row margin-top">
                                        @error("question_en")
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Question English <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input size="60" maxlength="255" value="{{ old("question_en") }}" class="form-control" name="question_en" type="text">
                                        </div>
                                    </div>

                                    <div class="row margin-top">
                                        @error("question_fr")
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Question France
                                                <span class="required">*</span>
                                            </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input size="60" maxlength="255" value="{{ old("question_fr") }}" class="form-control" name="question_fr" type="text">
                                        </div>
                                    </div>

                                    <div class="row margin-top ">
                                        @error("question_ar")
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Question Arabic <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input size="60" maxlength="255" value="{{ old("question_ar") }}" class="form-control" name="question_ar" style="text-align: right" type="text">
                                        </div>
                                    </div>

                                    <div class="row margin-top">
                                        @error("order")
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Order <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control" name="order" value="{{ old("order") ?: 0 }}" type="number">
                                        </div>
                                    </div>

                                    <div class="row margin-top ">
                                        @error("type")
                                            <div class="col-md-12">
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Type <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="type" class="form-control" required>
                                                <option value="">Choose Question Type</option>
                                                <option value="0">General Rating</option>
                                                <option value="1">Employee Rating</option>
                                                <option value="2">Custom</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row margin-top ">
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
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
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
