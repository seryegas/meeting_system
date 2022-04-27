<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question_name' => 'required|min:3|max:150',
            'meeting_id' => 'required'
        ]);
        $question = Question::create([
            'meeting_id' => $data['meeting_id'],
            'question_name' => $data['question_name'],
        ]);
        if (!$question)
        {
            return redirect(route('show_meeting', $data['meeting_id']))->withErrors([
                'any' => 'Произошла ошибка при добавлении вопроса'
            ]); 
        }
        $message = 'Вопрос добавлен';
        return redirect(route('show_meeting', $data['meeting_id']))->with('success', $message); // читать документацию
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($question_id)
    {
        $question = Question::where('question_id', $question_id)->first();
        $meeting_id = $question->meeting_id;
        $question->delete();
        return redirect(route('show_meeting', $meeting_id))->with('success', "Вопрос удален!");
    }
}
