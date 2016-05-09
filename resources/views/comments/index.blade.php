@extends('layouts.master')

@section('title')
    {{ $subject_name }}: {{ $thread->name }}
@stop

@section('content')

    <div class="subjects">
        @foreach(\App\Subject::all() as $subject)
            <a href='/{{ $subject->name }}'>{{ $subject->name }}</a>
        @endforeach
    </div>

    <div class="links">
        <a href='/{{ $subject_name }}'>Back</a>
    </div>

    <h1>thread: {{ $thread->name }}</h1>

    <div id='comments' class='cf'>
        <section class='comment'>
            {{ $thread->user->name }}
            {{ $thread->created_at }}
            #{{ $thread->id }}<br><br>
            {{ $thread->text }}
        </section>
    </div>

    <h1>comments</h1>
    <div id='comments' class='cf'>
        @foreach($comments as $comment)
            <section class='comment'>
                {{ $comment->user->name }}
                {{ $comment->created_at }}
                #{{ $comment->id }}<br><br>
                {{ $comment->text }}
            </section>
        @endforeach
    </div>

    <form method='POST' action='/{{ $subject_name }}/thread/{{ $thread->id }}'>

        {{ csrf_field() }}

        <br><div class='form-group'>
            <textarea
                type='text'
                id='text'
                name='text'
                rows='5'
                cols='50'
                placeholder='Add a comment'
            ></textarea>
        </div>

        <input
            type='hidden'
            name='subject_name'
            value='{{ $subject_name }}'
        >

        <input
            type='hidden'
            name='thread_id'
            value='{{ $thread->id }}'
        >

        <button type="submit" class="btn btn-primary">Post!</button>

    </form>

@stop