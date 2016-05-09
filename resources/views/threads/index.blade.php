@extends('layouts.master')

@section('title')
    {{ $subject_name }}
@stop

@section('content')

    <div class="subjects">
        @foreach(\App\Subject::all() as $subject)
            <a href='/{{ $subject->name }}'>{{ $subject->name }}</a>
        @endforeach
    </div>

    <form method='POST' action='/{{ $subject_name }}'>

        {{ csrf_field() }}

        <div class='form-group'>
           <label>Thread Name:</label>
            <input
                type='text'
                id='name'
                name='name'
            >
           <div class='error'>{{ $errors->first('name') }}</div>
        </div>

        <div class='form-group'>
           <label>Thread Comment:</label>
            <input
                type='text'
                id='text'
                name='text'
            >
           <div class='error'>{{ $errors->first('text') }}</div>
        </div>

        <input
            type='hidden'
            name='subject_id'
            value='{{ $subject_id }}'
        >

        <input
            type='hidden'
            name='subject_name'
            value='{{ $subject_name }}'
        >

        <div class='form-instructions'>
            All fields are required
        </div>

        <button type="submit" class="btn btn-primary">Create Thread!</button>

        <div class='error'>
            @if(count($errors) > 0)
                Please correct the errors above and try again.
            @endif
        </div>

    </form>

    <h1>{{ $subject_name }} threads</h1>
    <div id='threads' class='cf'>
        @foreach($threads as $thread)
            <section class='thread'>
                <a href='/{{ $subject_name }}/thread/{{ $thread->id }}'>{{ $thread->name }}</a>
                {{ $thread->text }}
                #{{ $thread->id }}
                {{ $thread->created_at }}
                {{ $thread->user->name }}
            </section>
        @endforeach
    </div>

@stop