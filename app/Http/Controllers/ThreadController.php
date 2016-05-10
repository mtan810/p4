<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThreadController extends Controller {

    /**
    * Responds to requests to GET /{subject?}
    */
    public function getIndex($subject_name = null) {

        # Get the subject based on the subject name
        $subject = \App\Subject::where("name", "=", $subject_name)->first();

        # Redirect to the homepage if subject does not exist
        if(is_null($subject)) {
            \Session::flash('message','Subject not found!');
            return redirect('/');
        }

        # Get all the threads within the subject
        $threads = \App\Thread::with('user')->where('subject_id', '=', $subject->id)->orderBy('id','desc')->get();

        return view('threads.index',[
            'subject_id' => $subject->id,
            'subject_name' => $subject_name,
            'threads' => $threads,
        ]);

    }

    /**
    * Responds to requests to POST /{subject?}
    *
    * Create a thread
    */
    public function postIndex(Request $request) {

        # Validate the thread
        $this->validate($request,[
            'name' => 'required|max:30',
            'text' => 'required|max:255',
        ]);

        # Get the thread data
        $data = $request->only('name','text','subject_id');
        $data['user_id'] = \Auth::id();

        # Create the thread
        $thread = \App\Thread::create($data);

        # Thread is created
        \Session::flash('message','Your thread is created!');

        return redirect('/'.$request->input('subject_name'));

    }

}
