<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex($subject_name = null, $thread_id = null) {

        $subject = \App\Subject::where("name", "=", $subject_name)->first();

        if(is_null($subject)) {
            \Session::flash('message','Subject not found');
            return redirect('/');
        }

		$thread = \App\Thread::where('subject_id', '=', $subject->id)->where('id', '=', $thread_id)->first();

        if(is_null($thread)) {
            \Session::flash('message','Thread not found');
            return redirect('/'.$subject_name);
        }

        $comments = \App\Comment::with('user')->where('thread_id', '=', $thread_id)->get();

        return view('comments.index',[
            'subject_name' => $subject_name,
            'thread' => $thread,
            'comments' => $comments,
        ]);

    }

    public function postIndex(Request $request) {

        if (!\Auth::check()) {
            \Session::flash('message','You must be logged in to post a comment!');
            return redirect('/'.$request->input('subject_name').'/thread/'.$request->input('thread_id'));
        }

        $this->validate($request,[
            'text' => 'required',
        ]);

        $data = $request->only('text','thread_id');
        $data['user_id'] = \Auth::id();

        $comment = \App\Comment::create($data);

        \Session::flash('message','Your comment was posted!');

        return redirect('/'.$request->input('subject_name').'/thread/'.$request->input('thread_id').'#bottom');

    }

}
