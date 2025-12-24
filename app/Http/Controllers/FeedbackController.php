<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbackItems = Feedback::latest()->paginate(10);
        return view('pages.data', compact('feedbackItems'));
    }

    public function showForm()
    {
        return view("pages.feedback");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|min:10',
        ]);

        Feedback::create($validated);

        return redirect()->route('feedback.form')->with('success', 'Message sent successfully!');
    }

    public function edit(Feedback $feedback)
    {
        return view('pages.feedback_edit', compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'message' => 'required|string|min:10',
        ]);

        $validated['is_reviewed'] = $request->has('is_reviewed');

        $feedback->update($validated);
        return redirect()->route('feedback.data')->with('success', 'Updated!');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return back()->with('success', 'Deleted successfully');
    }
}