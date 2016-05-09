<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {

        return view('account.index');

    }

    public function postIndex(Request $request) {

        $this->validate($request,[
            'password' => 'required|min:6|confirmed',
        ]);

        $user = \App\User::find(\Auth::id());

        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();

        \Session::flash('message','Your password is updated!');

        return redirect('/account');

    }

}
