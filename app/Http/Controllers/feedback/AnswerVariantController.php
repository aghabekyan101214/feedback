<?php

namespace App\Http\Controllers\feedback;

use Illuminate\Http\Request;
use App\AnswerVariant;
use App\Question;
use App\Http\Controllers\Controller;

class AnswerVariantController extends Controller
{

    const URL = "/admin/feedback/answers";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = AnswerVariant::with("questions")->get();
        return view("feedback.variants.index", compact("answers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::where("type", Question::RADIO)->get();
        return view("feedback.variants.create", compact("questions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_id' => 'required|integer',
            'answer_en'   => 'required|max:255',
            'answer_fr'   => 'required|max:255',
            'answer_am'   => 'required|max:255',
            'answer_ru'   => 'required|max:255',
            'answer_ar'   => 'required|max:255',
        ]);

        $question = Question::find($request->question_id);
        $variant = new AnswerVariant();
        $variant->answer_en = $request->answer_en;
        $variant->answer_fr = $request->answer_fr;
        $variant->answer_am = $request->answer_am;
        $variant->answer_ru = $request->answer_ru;
        $variant->answer_ar = $request->answer_ar;
        $question->variants()->save($variant);

        return redirect(self::URL);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AnswerVariant::with("questions")->find($id);
        return view("feedback.variants.edit", compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'question_id' => 'required|integer',
            'answer_en'   => 'required|max:255',
            'answer_fr'   => 'required|max:255',
            'answer_am'   => 'required|max:255',
            'answer_ru'   => 'required|max:255',
            'answer_ar'   => 'required|max:255',
        ]);

        $variant = AnswerVariant::find($id);
        $variant->answer_en = $request->answer_en;
        $variant->answer_fr = $request->answer_fr;
        $variant->answer_am = $request->answer_am;
        $variant->answer_ru = $request->answer_ru;
        $variant->answer_ar = $request->answer_ar;
        $variant->save();

        return redirect(self::URL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AnswerVariant::find($id)->delete();
        return redirect(self::URL);
    }

    /**
     * Activate/Deactivate the specified resource status.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)
    {
        $question = Question::find($request->id);
        $question->active = $request->status;
        $question->save();
    }
}
