<?php

namespace App\Http\Controllers;
use App\ZoomMeeting;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function index()
    {
        $meetings = ZoomMeeting::get();

        return view('back.pages.zoom.index', compact('meetings'));
    }

    public function create()
    {
        return view('back.pages.zoom.create');
    }

    public function store(Request $request)
    {
        try {
        // Validate the form data
        $validatedData = $request->validate([

            'meeting_name' => 'required|string|max:255',
            'meeting_password' => 'required|string|max:25',
            'meeting_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);

        // Create a new user instance
        $meeting = new ZoomMeeting([
            'meeting_name' => $validatedData['meeting_name'],
            'meeting_password' => $validatedData['meeting_password'],
            'meeting_date' => $validatedData['meeting_date'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
        ]);
        // Save the user data
        $meeting->save();
        // Assign roles using Spatie's role package
        session()->flash('success', 'A meeting has been created!');
        return redirect()->route('admin.zoom.index');
    } catch (\Exception $e) {
        session()->flash('error', 'Something went wrong. Please try again.');
        return redirect()->route('admin.zoom.index');
    }

    }

    public function edit($id)
    {
        $meeting = ZoomMeeting::find($id);
        return view('back.pages.zoom.edit', compact('meeting'));

    }

    public function update(Request $request, $id)
    {
        try {
        // Validate the form data
        $validatedData = $request->validate([

            'meeting_name' => 'required|string|max:255',
            'meeting_password' => 'nullable|string|max:25',
            'meeting_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',

        ]);

        $meeting = ZoomMeeting::findOrFail($id);
        // Create a new user instance
        $meeting->meeting_name = $validatedData['meeting_name'];
        $meeting->meeting_date = $validatedData['meeting_date'];
        $meeting->start_time = $validatedData['start_time'];
        $meeting->end_time = $validatedData['end_time'];

        if (!empty($validatedData['meeting_password'])) {
            $meeting->meeting_password = $validatedData['meeting_password'];
        }
        // Save the user data
        $meeting->save();
        // Assign roles using Spatie's role package
        session()->flash('success', 'The meeting has been updated!');
        return redirect()->route('admin.zoom.index');
    } catch (\Exception $e) {
        session()->flash('error', 'The meeting has not been updated!');
        return redirect()->route('admin.zoom.index');
    }
    }

    public function destroy($id)
    {
     try {
        $user = ZoomMeeting::find($id);
        $user->delete();
        session()->flash('success', 'The meeting has been deleted!');
        return redirect()->route('admin.zoom.index');
    } catch (\Exception $e) {
        session()->flash('error', 'The meeting has not been deleted!');
        return redirect()->route('admin.zoom.index');
    }
    }
}
