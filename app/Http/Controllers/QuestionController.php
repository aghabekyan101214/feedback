<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    private $folder = "questions";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(50);
        return view("$this->folder.index", compact("questions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("$this->folder.create");
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
            'question_en' => 'required|max:255',
            'question_fr' => 'required|max:255',
            'question_ar' => 'required|max:255',
            'order'       => 'required|unique:questions',
            'type'        => 'required|integer',
            'active'      => 'required|integer'
        ]);

        $question = new Question();
        $question->question_en = $request->question_en;
        $question->question_fr = $request->question_fr;
        $question->question_ar = $request->question_ar;
        $question->order       = $request->order;
        $question->type        = $request->type;
        $question->active      = $request->active;
        $question->save();
        return redirect("admin/questions");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view("$this->folder.show", compact("question"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view("$this->folder.edit", compact("question"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_en' => 'required|max:255',
            'question_fr' => 'required|max:255',
            'question_ar' => 'required|max:255',
            'order'       => 'required',
            'type'        => 'required|integer',
            'active'      => 'required|integer'
        ]);

        $question->question_en = $request->question_en;
        $question->question_fr = $request->question_fr;
        $question->question_ar = $request->question_ar;
        $question->order       = $request->order;
        $question->type        = $request->type;
        $question->active      = $request->active;
        $question->save();
        return redirect("admin/questions");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect("/admin/questions");
    }

    public function change_status(Request $request)
    {
        $question = Question::find($request->id);
        $question->active = $request->status;
        $question->save();
    }
}
