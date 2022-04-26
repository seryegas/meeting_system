<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::where('company_id', session('company_id'))->get();
        return view('meeting.meetings',compact('meetings'));
    }

    public function create()
    {
        return view('meeting.create_meeting');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'meeting_name' => 'required|min:3',
            'meeting_description' => 'required|max:150',
            'date' => 'required|date',
        ]);

        $meeting = Meeting::create([
            'meeting_name' => $validatedData['meeting_name'],
            'description' => $validatedData['meeting_description'],
            'company_id' => session('company_id'),
            'meeting_time' => $validatedData['date'],
        ]);
        if (!$meeting)
        {
            return redirect(route('create_meeting'))->withErrors([
                'any' => 'Произошла ошибка при создании конференции'
            ]);
        }
        $message = 'Собрание создано';
        return redirect(route('create_meeting'))->with('success', $message);
    }

    public function show($meeting_id)
    {
        $meeting = Meeting::where('meeting_id',$meeting_id)->first();
        return view('meeting.show_meeting', compact('meeting'));
    }
}
