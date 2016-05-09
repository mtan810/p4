<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectController extends Controller {

    /**
    * Responds to requests to GET /
    */
    public function getIndex() {

    	$subjects = \App\Subject::all();

        return view('subjects.index',[
            'subjects' => $subjects,
        ]);

    }

}
