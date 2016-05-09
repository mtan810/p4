<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThreadController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($subject_name = null) {

        $subject = \App\Subject::where("name", "=", $subject_name)->first();

        if(is_null($subject)) {
            \Session::flash('message','Subject not found');
            return redirect('/');
        }

        $threads = \App\Thread::with('user')->where('subject_id', '=', $subject->id)->orderBy('id','desc')->get();

        return view('threads.index',[
            'subject_id' => $subject->id,
            'subject_name' => $subject_name,
            'threads' => $threads,
        ]);

    }

    public function postIndex(Request $request) {

        if (!\Auth::check()) {
            \Session::flash('message','You must be logged in to create a new thread!');
            return redirect('/'.$request->input('subject_name'));
        }

        $this->validate($request,[
            'name' => 'required',
            'text' => 'required',
        ]);

        $data = $request->only('name','text','subject_id');
        $data['user_id'] = \Auth::id();

        $thread = \App\Thread::create($data);

        \Session::flash('message','Your thread was created!');

        return redirect('/'.$request->input('subject_name'));

    }

}
