<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Task;
use App\Models\User;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks_new = Task::where('task_recipient_id', session('user_id'))->where('task_status', 0)->get();
        $tasks_accepted = Task::where('task_recipient_id', session('user_id'))->where('task_status', 1)->get();
        $tasks_on_check = Task::where('task_recipient_id', session('user_id'))->where('task_status', 2)->get();
        return view('profile.tasks', compact('tasks_new', 'tasks_accepted', 'tasks_on_check'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('company_id', session('company_id'))->get();
        return view('meeting.create_task', compact('users'));
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
            'user_id' => 'required|numeric',
            'task_text' => 'required|min:3|max:1000',
            'help_file' => 'file|mimes:docx,pdf|max:10240',
        ]);

        $has_file = 0;

        if ($request->hasFile('help_file'))
        {
            $has_file = 1;
        }

        $task = Task::create([
            'task_recipient_id' => $data['user_id'],
            'task_text' => $data['task_text'],
            'has_file' => $has_file,
        ]);

        Notification::create([
            'note_recipient_id' => $data['user_id'],
            'note_text' => "У вас новое задание",
            'note_status' => 1,
            'note_type' => 2,
            'note_help_col' => -1,
        ]);

        if ($request->hasFile('help_file'))
        {
            $request->file('help_file')->storeAs('public/files/tasks', $task->task_id . '.' . $request->file('help_file')->getClientOriginalExtension());
        }
        return redirect(route('create_task'))->with('success', 'Задание создано');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function change_status($task_id, $type)
    {
        $task = Task::find($task_id);
        $task->task_status = $type;
        $task->save();
        return redirect(route('tasks'))->with('success', "Задача принята!");
    }

    public static function download_file($task_id)
    {
        $outputPath = '';
        $filetype = '';
        if (file_exists(Storage::path('public/files/tasks/') . $task_id . '.docx'))
        {
            $outputPath = Storage::path('public/files/tasks/') . $task_id . '.docx';
            $filetype = '.docx';
        }
        elseif (file_exists(Storage::path('public/files/tasks/') . $task_id . '.pdf'))
        {
            $outputPath = Storage::path('public/files/tasks/') . $task_id . '.pdf';
            $filetype = '.pdf';
        }
        else
        {
            return redirect(route('tasks'))->withErrors(['any' => 'Не выбран сотрудник']);
        }
        $downdloadFile = $outputPath;
        $file_name = session('user_name');

        header("Content-Type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Content-Length: ".filesize($downdloadFile));
        header('Content-Disposition: attachment; filename=' . $file_name . $filetype);  
        header('Content-type: application/pdf', true);


        readfile($downdloadFile);
        return redirect(route('tasks'));
    }
}
