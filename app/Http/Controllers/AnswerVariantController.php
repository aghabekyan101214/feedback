<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AnswerVariant;
use App\Question;

class AnswerVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = AnswerVariant::with("questions")->get();
        return view("variants.index", compact("answers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $questions = Question::all();
        return view("variants.create", compact("questions"));
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
            'answer_ar'   => 'required|max:255',
        ]);

        $question = Question::find($request->question_id);
        $variant = new AnswerVariant();
        $variant->answer_en = $request->answer_en;
        $variant->answer_fr = $request->answer_fr;
        $variant->answer_ar = $request->answer_ar;
        $question->variants()->save($variant);
        return redirect("admin/answers");
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
        return view("variants.edit", compact("data"));
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
        $variant = AnswerVariant::find($id);
        $variant->answer_en = $request->answer_en;
        $variant->answer_fr = $request->answer_fr;
        $variant->answer_ar = $request->answer_ar;
        $variant->save();
        return redirect('admin/answers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
