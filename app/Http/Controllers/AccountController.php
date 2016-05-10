<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {

    /**
    * Responds to requests to GET /account
    */
    public function getIndex() {

        return view('account.index');

    }

    /**
    * Responds to requests to POST /account
    *
    * Update user's password
    */
    public function postIndex(Request $request) {

        # Validate the password
        $this->validate($request,[
            'password' => 'required|min:6|confirmed',
        ]);

        # Get the user
        $user = \App\User::find(\Auth::id());

        # Change the user's password
        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();

        # User password is updated
        \Session::flash('message','Your password is updated!');

        return redirect('/account');

    }

    /**
    * Responds to requests to POST /account
    *
    * Update user's theme
    */
     public function editTheme(Request $request) {

        # Validate the theme
        $this->validate($request,[
            'theme' => 'required',
        ]);

        # Get the user
        $user = \App\User::find(\Auth::id());

        # Change the user's theme
        $user->theme = $request->theme;
        $user->save();

        # User theme is updated
        \Session::flash('message','Your theme is updated!');

        return redirect('/account');

     }

}
