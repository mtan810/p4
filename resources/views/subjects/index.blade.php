@extends('layouts.master')

@section('content')

	<h1>Welcome to mchan!</h1>
	<p>
		To get started, just pick a subject and start browsing.
		Once you <a href='/login'><u>log in</u></a> or <a href='/register'><u>register</u></a>, you can join in the discussion by creating new threads
		or selecting an existing thread and begin posting comments. Below is a list of subjects that you can choose from.
    
    <div id='subjects' class='cf'>
        @foreach($subjects as $subject)
            <a href='/{{ $subject->name }}'>
                <div class='subject'>
                    <img src="/images/{{ $subject->name }}.png" alt="{{ $subject->name }}">
                    {{ $subject->name }}
                </div>
            </a>
        @endforeach
    </div>

@stop
