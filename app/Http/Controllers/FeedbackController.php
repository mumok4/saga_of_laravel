<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FeedbackController extends Controller
{
    public function showForm()
    {
        return view("pages.feedback");
    }

    public function submitForm(Request $request)
    {
        $validateData = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email',
            'message'=>'required|string|min:10',            
        ]);


        $filename = 'feedback_' . now()->format('Y-m-d_H-i-s') . '_' . Str::random(8) . '.json';
        $dataToSave = json_encode($validateData, JSON_PRETTY_PRINT);

        Storage::disk('local')->put('feedback/' . $filename, $dataToSave);

        return redirect()->route('feedback.form')->with('success','Message was sent');
    }

    public function showData()
    {
        $files = Storage::disk('local') -> files('feedback');
        $feedbackData = [];
        
        foreach ($files as $file){
            $content = Storage::disk('local') -> get($file);
            $feedbackData[] = json_decode($content, true);
        }

        return view('pages.data', ['feedbackItems' => $feedbackData]);
    }
}
