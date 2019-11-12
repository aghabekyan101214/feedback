@extends("layouts.app")
@section("content")
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h1>{{ $data->questions->question_en }}</h1>
                </div>
                <form action="/admin/answers/{{ $data->id }}" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                @csrf
                                @method("PUT")

                                <div class="row margin-top">
                                    <div class="col-md-4">
                                        <label class="required">Variant English <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $data->answer_en }}" class="form-control" name="answer_en" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    <div class="col-md-4">
                                        <label class="required">Variant French <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $data->answer_fr }}" class="form-control" name="answer_fr" type="text">
                                    </div>
                                </div>

                                <div class="row margin-top">
                                    <div class="col-md-4">
                                        <label class="required">Variant Arabic <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input size="60" maxlength="255" value="{{ $data->answer_ar }}" style="text-align: right" class="form-control" name="answer_ar" type="text">
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
