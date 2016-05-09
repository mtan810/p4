@extends('layouts.master')

@section('title')
    {{ $user->name }}'s account settings
@stop

@section('content')
	
	<h1>{{ $user->name }}'s profile</h1>

	<h3>Email address: {{ $user->email }}</h3>

    <form method='POST' action='/account'>

        {!! csrf_field() !!}

        <div class='form-group'>
            <label for='password'>Change Password (Min length: 6)</label>
            <input type='password' name='password' id='password' placeholder='Enter new password here'>
        </div>
        <div class='error'>{{ $errors->first('password') }}</div>

        <div class='form-group'>
            <label for='password_confirmation'>Confirm Password</label>
            <input type='password' name='password_confirmation' id='password_confirmation' placeholder='Confirm new password'>
        </div>
        <div class='error'>{{ $errors->first('password_confirmation') }}</div>

        <button type='submit' class='btn btn-primary'>Change password!</button>

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>

@stop