<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
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
            'solution_desc' => 'required|min:3|max:150',
            'question_id' => 'required'
        ]);
        $solution = Solution::create([
            'solution_desc' => $data['solution_desc'],
            'question_id' => $data['question_id']
        ]);
        if (!$solution)
        {
            return redirect(route('show_question', $data['question_id']))->withErrors([
                'any' => 'Произошла ошибка при добавлении решения'
            ]); 
        }
        $message = 'Вопрос добавлен';
        return redirect(route('show_question', $data['question_id']))->with('success', $message); 
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function edit(Solution $solution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solution $solution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solution  $solution
     * @return \Illuminate\Http\Response
     */
    public function destroy($solution_id)
    {
        $solution = Solution::where('solution_id', $solution_id)->first();
        $question_id = $solution->question_id;
        $solution->delete();
        return redirect(route('show_question', $question_id))->with('success', "Решение удалено!");
    }
}
