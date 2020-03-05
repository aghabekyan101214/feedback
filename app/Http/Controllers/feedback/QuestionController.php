<?php

namespace App\Http\Controllers\feedback;

use App\AnswerVariant;
use App\models\feedback\RatingAnswer;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    const URL = "/admin/feedback/questions";

    private $folder = "feedback.questions";
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $questions = Question::orderBy("id", "desc")->paginate(50);
        foreach ($questions as $bin => $question) {
            if($question->type == 0) {
                $avg = RatingAnswer::where("question_id", $question->id)->avg("rate");
                $questions[$bin]->avgRating = floatval($avg);
            }
        }

        $types = Question::TYPES;
        $groups = Question::GROUPS;
        return view("$this->folder.index", compact("questions", "types", "groups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $types = Question::TYPES;
        $groups = Question::GROUPS;
        return view("$this->folder.create", compact("types", "groups"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required|max:255',
            'question_fr' => 'required|max:255',
            'question_am' => 'required|max:255',
            'question_ru' => 'required|max:255',
            'question_ar' => 'required|max:255',
            'type'        => 'required|integer',
            'active'      => 'required|integer',
            'group'       => 'required|integer'
        ]);

        $question = new Question();
        $question->question_en = $request->question_en;
        $question->question_fr = $request->question_fr;
        $question->question_am = $request->question_am;
        $question->question_ru = $request->question_ru;
        $question->question_ar = $request->question_ar;
        $question->group        = $request->group;
        $question->type        = $request->type;
        $question->active      = $request->active;
        $question->save();

        return redirect(self::URL);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     */
    public function show(Question $question)
    {
        $types = Question::TYPES;
        $groups = Question::GROUPS;
        return view("$this->folder.show", compact("question", "types", "groups"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     */
    public function edit(Question $question)
    {
        $types = Question::TYPES;
        $groups = Question::GROUPS;
        return view("$this->folder.edit", compact("question", "types", "groups"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_en' => 'required|max:255',
            'question_fr' => 'required|max:255',
            'question_am' => 'required|max:255',
            'question_ru' => 'required|max:255',
            'question_ar' => 'required|max:255',
            'type'        => 'required|integer',
            'active'      => 'required|integer',
            'group'       => 'required|integer'
        ]);

        $question->question_en = $request->question_en;
        $question->question_fr = $request->question_fr;
        $question->question_am = $request->question_am;
        $question->question_ru = $request->question_ru;
        $question->question_ar = $request->question_ar;
        $question->group       = $request->group;
        $question->type        = $request->type;
        $question->active      = $request->active;
        $question->save();

        return redirect(self::URL);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect(self::URL);
    }

    public function change_status(Request $request)
    {
        $question = Question::find($request->id);
        $question->active = $request->status;
        $question->save();
    }

    public function show_answer($id)
    {
        $data = Question::with(['clients_answers' => function ($query) {
            return $query->with(["clients", "employee"]);
        }])->find($id);
        return view($this->folder.".show_answer", compact("data"));
    }
}
