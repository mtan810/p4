<?php

# ------------------------------------
# Authentication
# ------------------------------------
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');

Route::get('/logout', 'Auth\AuthController@logout');


# ------------------------------------
# Misc debug routes
# ------------------------------------
# Restrict certain routes to only be viewable in the local environments
if(App::environment('local')) {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/drop', function() {
        DB::statement('DROP database mchan');
        DB::statement('CREATE database mchan');
        return 'Dropped mchan; created mchan.';
    });

    # Debugging route just to show whether you're logged in or not
    Route::get('/show-login-status', function() {

        # You may access the authenticated user via the Auth facade
        $user = Auth::user();

        if($user) {
            echo 'You are logged in.';
            dump($user->toArray());
        } else {
            echo 'You are not logged in.';
        }

        return;

    });

    Route::get('/debug', function() {

        echo '<pre>';

        echo '<h1>Environment</h1>';
        echo App::environment().'</h1>';

        echo '<h1>Debugging?</h1>';
        if(config('app.debug')) echo "Yes"; else echo "No";

        echo '<h1>Database Config</h1>';
        /*
        The following line will output your MySQL credentials.
        Uncomment it only if you're having a hard time connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your live server, making your credentials public.
        */
        //print_r(config('database.connections.mysql'));

        echo '<h1>Test Database Connection</h1>';
        try {
            $results = DB::select('SHOW DATABASES;');
            echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
            echo "<br><br>Your Databases:<br><br>";
            print_r($results);
        }
        catch (Exception $e) {
            echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
        }

        echo '</pre>';

    });
}


# ------------------------------------
# Main specific routes
# ------------------------------------

Route::get('/', 'SubjectController@getIndex');                                      # Home, get all the subjects

Route::group(['middleware' => 'auth'], function() {
    Route::get('/account', 'AccountController@getIndex');                           # Go to user's account profile page
    Route::post('/account', 'AccountController@postIndex');                         # Edit account password
    Route::post('/theme', 'AccountController@editTheme');                           # Edit theme

    Route::post('/{subject?}', 'ThreadController@postIndex');                       # Create a new thread in a subject

    Route::post('/{subject?}/thread/{thread?}', 'CommentController@postIndex');     # Post a new comment in a thread
    Route::get('/delete/{comment?}', 'CommentController@getDelete');                # Delete a comment in a thread
});

Route::get('/{subject?}', 'ThreadController@getIndex');                             # Get all the threads in a subject

Route::get('/{subject?}/thread/{thread?}', 'CommentController@getIndex');           # Get all the comments in a thread
