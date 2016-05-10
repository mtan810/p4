<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller {

    /**
    * Responds to requests to GET /{subject?}/thread/{thread?}
    */
    public function getIndex($subject_name = null, $thread_id = null) {

        # Get the subject based on the subject name
        $subject = \App\Subject::where("name", "=", $subject_name)->first();

        # Redirect to the homepage if subject does not exist
        if(is_null($subject)) {
            \Session::flash('message','Subject not found!');
            return redirect('/');
        }

        # Get the thread based on the subject id and thread id
        $thread = \App\Thread::where('subject_id', '=', $subject->id)->where('id', '=', $thread_id)->first();

        # Redirect to the subject page if the thread does not exist
        if(is_null($thread)) {
            \Session::flash('message','Thread not found!');
            return redirect('/'.$subject_name);
        }

        # Get all the comments within the thread
        $comments = \App\Comment::with('user')->where('thread_id', '=', $thread_id)->get();

        return view('comments.index',[
            'subject_name' => $subject_name,
            'thread' => $thread,
            'comments' => $comments,
        ]);

    }

    /**
    * Responds to requests to POST /{subject?}/thread/{thread?}
    *
    * Post a comment
    */
    public function postIndex(Request $request) {

        # Validate the comment
        $this->validate($request,[
            'text' => 'required',
        ]);

        # Get the comment data
        $data = $request->only('text','thread_id');
        $data['user_id'] = \Auth::id();

        # Create the comment
        $comment = \App\Comment::create($data);

        # Comment is posted
        \Session::flash('message','Your comment is posted!');

        return redirect('/'.$request->input('subject_name').'/thread/'.$request->input('thread_id').'#bottom');

    }

    /**
    * Responds to requests to POST /delete/{comment?}
    *
    * Delete a comment
    */
    public function getDelete($comment_id) {

        # Get the user's comment to be deleted
        $comment = \App\Comment::where("user_id", "=", \Auth::id())->find($comment_id);

        # Flash message if comment cannot be found or if user tries to delete someone else's comment
        if(is_null($comment)) {
            return \Redirect::back()->with('message','Comment not found!');
        }

        # Delete the comment
        $comment->delete();

        return \Redirect::back()->with('message','Your comment is deleted!');

    }

}
