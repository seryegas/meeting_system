<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\NotificationSent;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::where('company_id', session('company_id'))->get()->sortByDesc('is_online');;
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
        return redirect(route('meetings'))->with('success', $message);
    }

    public function show($meeting_id)
    {
        $meeting = Meeting::where('meeting_id',$meeting_id)->first();
        $questions = Question::with('users')->where('meeting_id', $meeting->meeting_id)->get();
        $users = User::where('company_id', session('company_id'))->get();
        return view('meeting.show_meeting', compact('meeting', 'questions', 'users'));
    }

    public function change_status($meeting_id, $type)
    {
        $meeting = Meeting::where('meeting_id', $meeting_id)->first();
        $meeting->is_online = $type;
        $meeting->save();
        return redirect(route('show_meeting', $meeting_id));
    }

    public function destroy($meeting_id)
    {
        Question::where('meeting_id', $meeting_id)->delete();
        Meeting::find($meeting_id)->delete();
        return redirect(route('meetings', $meeting_id))->with('success', "Собрание удалено!");
    }

    public static function send_notes($company_id, $note_type)
    {
        $users = User::where('company_id', $company_id)->get();
        foreach($users as $user)
        {
            Notification::create([
                
            ]);
        }
    }
}
