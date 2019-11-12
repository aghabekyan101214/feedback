@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>Create Answer</h1>
                </div>
                <form action="/admin/answers" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                <div class="row margin-top">
                                    @error("question_id")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Select Question <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="question_id" class="form-control" required id="">
                                            <option value="">Select Question</option>
                                            @foreach($questions as $question)
                                                <option value="{{ $question->id }}">{{ $question->question_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("answer_en")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Variant English <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ old('answer_en') }}" class="form-control" name="answer_en" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("answer_fr")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Variant French <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ old('answer_fr') }}" class="form-control" name="answer_fr" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    @error("answer_ar")
                                    <div class="col-md-12">
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    </div>
                                    @enderror
                                    <div class="col-md-4">
                                        <label class="required">Variant Arabic <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ old('answer_ar') }}" style="text-align: right" class="form-control" name="answer_ar" type="text">
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
