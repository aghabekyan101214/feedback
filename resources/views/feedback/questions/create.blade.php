@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create Question</h1>
                </div>
                <form action="/admin/feedback/questions" method="post">
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

                                <div class="row margin-top">
                                    @error("question_am")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Question Armenian
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ old("question_am") }}" class="form-control" name="question_am" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("question_ru")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Question Russian
                                            <span class="required">*</span>
                                        </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ old("question_ru") }}" class="form-control" name="question_ru" type="text">
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

                                    <div class="row margin-top ">
                                        @error("group")
                                        <div class="col-md-12">
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        </div>
                                        @enderror
                                        <div class="col-md-4">
                                            <label class="required">Group <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="group" class="form-control" required>
                                                <option value="">Choose Question Group</option>
                                                @foreach($groups as $bin => $group)
                                                    <option @if(old("group") == $bin) selected @endif value="{{ $bin }}">{{ ucfirst($group) }}</option>
                                                @endforeach
                                            </select>
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
                                                @foreach($types as $bin => $type)
                                                    <option @if(old("type") == $bin) selected @endif value="{{ $bin }}">{{ ucfirst(trans($type)) }}</option>
                                                @endforeach
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
