@extends('layouts.master')

@section('title')
    {{ $user->name }}'s account settings
@stop

@section('content')

    @if(Session::get('message') != null)
        <div class='flash_message'>{{ Session::get('message') }}</div>
    @endif

    <br><div class="links">
        <a href='/'>Home</a>
    </div>
	
	<h1>{{ $user->name }}'s profile</h1>

    <div class="container">
        <h3>Email address: {{ $user->email }}</h3>

        <form method='POST' action='/account'>

            {{ csrf_field() }}

            <div class='form-group'>
                <label for='password'>Change Password (Min length: 6)</label>
                <input type='password' name='password' id='password' placeholder='Enter new password here'>
                <div class='error'>{{ $errors->first('password') }}</div>
            </div>

            <div class='form-group'>
                <label for='password_confirmation'>Confirm Password</label>
                <input type='password' name='password_confirmation' id='password_confirmation' placeholder='Confirm new password'>
                <div class='error'>{{ $errors->first('password_confirmation') }}</div>
            </div>

            <button type='submit' class='btn btn-primary'>Change password!</button>

            <div class='error'>
                @if(count($errors) > 0)
                    Please correct the errors above and try again.
                @endif
            </div>

        </form>
    </div>

    <div class="container">
        <h3>Change theme</h3>

        <form method='POST' action='/theme'>

            {{ csrf_field() }}

            <div class='radio'>
                <label><input type='radio' name='theme' value="1" {{ ($user->theme == 1) ? 'checked' : '' }}>Default</label>
                <label><input type='radio' name='theme' value="2" {{ ($user->theme == 2) ? 'checked' : '' }}>Tune</label>
                <label><input type='radio' name='theme' value="3" {{ ($user->theme == 3) ? 'checked' : '' }}>Gear</label>
            </div>

            <button type='submit' class='btn btn-primary'>Change theme!</button>

            <div class='error'>
                @if(count($errors) > 0)
                    Please correct the errors above and try again.
                @endif
            </div>

        </form>
    </div>

@stop