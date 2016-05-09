@extends('layouts.master')

@section('title')
    {{ $subject_name }}: {{ $thread->name }}
@stop

@section('content')

    <div class="subjects">
        @foreach(\App\Subject::all() as $subject)
            &nbsp;&nbsp;&nbsp;<a href='/{{ $subject->name }}'>{{ $subject->name }}</a>&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>

    <br><div class="links">
        <a href='/{{ $subject_name }}'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}/thread/{{ $thread->id }}#bottom'>Bottom</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}/thread/{{ $thread->id }}'>Update</a>
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
                {!! nl2br(e($comment->text)) !!}
            </section>
        @endforeach
    </div>

    <br><form method='POST' action='/{{ $subject_name }}/thread/{{ $thread->id }}'>

        {{ csrf_field() }}

        <div class='form-group'>
            <textarea
                type='text'
                id='text'
                name='text'
                rows='5'
                cols='60'
                maxlength='255'
                placeholder='Add a comment (255 characters max)'
            >{{ old('text') }}</textarea>
            <div class='error'>{{ $errors->first('text') }}</div>
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

    <br><br><div id="bottom" class="links">
        <a href='/{{ $subject_name }}'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}/thread/{{ $thread->id }}#top'>Top</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}/thread/{{ $thread->id }}'>Update</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </div>

    @if(Session::get('message') != null)
        <div class='flash_message'>{{ Session::get('message') }}</div>
    @endif

@stop