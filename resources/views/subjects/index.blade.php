@extends('layouts.master')

@section('content')

	<h1>Welcome to mchan!</h1>
	<p>
		To get started, just pick a subject and start browsing.
		Once you <a href='/login'>log in</a> or <a href='/register'>register</a>, you can join in the discussion by creating new threads
		or selecting an existing thread and begin posting comments. Below is a list of subjects that you can choose from.
    
    <div id='subjects' class='cf'>
        @foreach($subjects as $subject)
            <section class='subject'>
        		<a href='/{{ $subject->name }}'>{{ $subject->name }}</a>
            </section>
        @endforeach
    </div>

@stop
