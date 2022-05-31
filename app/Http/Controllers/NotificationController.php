<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Notification::where('note_recipient_id', session('user_id'))->orderBy('note_id', 'DESC')->get()->sortByDesc('note_status');
        return view('profile.notifications',compact('notes'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($notification_id)
    {
        Notification::find($notification_id)->delete();
        return redirect(route('show_notes'))->with('success', "Уведомление удалено!");
    }

    public function destroy_all()
    {
        Notification::where('note_recipient_id', session('user_id'))->delete();
        return redirect(route('show_notes'))->with('success', "Список уведомлений очищен!");
    }

    public function change_status($note_id)
    {
        $meeting = Notification::find($note_id);
        $meeting->note_status = 0;
        $meeting->save();
        return redirect(route('show_notes'));
    }
}
