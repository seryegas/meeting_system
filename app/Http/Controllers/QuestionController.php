<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Question;
use App\Models\Solution;
use App\Models\User;
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
            'meeting_id' => 'required',
            'user_id' => 'required|numeric'
        ]);
        $question = Question::create([
            'meeting_id' => $data['meeting_id'],
            'question_name' => $data['question_name'],
            'speaker_id' => $data['user_id'],
            'description' => ''
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
    public function show($question_id)
    {
        $question = Question::find($question_id);
        $solutions = Solution::where('question_id', $question_id)->get();
        $meeting = Meeting::where('meeting_id',$question->meeting_id)->first();
        $users = User::where('company_id', session('company_id'))->get();
        return view('question.show_question', compact('meeting', 'question', 'users', 'solutions'));
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
    public function update(Request $request)
    {
        $data = $request->validate([
            'description' => 'min:3|max:1000',
            'question_id' => 'numeric'
        ]);
        $question = Question::find($data['question_id']);
        $question->update([
            'description' => $data['description'],
        ]);
        return redirect(route('show_question', $question->question_id))->with('success', 'Данные изменены');
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
        Solution::where('question_id', $question_id)->delete();
        $question->delete();
        return redirect(route('show_meeting', $meeting_id))->with('success', "Вопрос удален!");
    }
}
