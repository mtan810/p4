@extends('layouts.master')

@section('title')
    {{ $subject_name }}
@stop

@section('content')

    @if(Session::get('message') != null)
        <div class='flash_message'>{{ Session::get('message') }}</div>
    @endif

    <div class='subjects'>
        @foreach(\App\Subject::all() as $subject)
            &nbsp;&nbsp;&nbsp;<a href='/{{ $subject->name }}'>{{ $subject->name }}</a>&nbsp;&nbsp;&nbsp;
        @endforeach
    </div>

    <div id='thread-form'>
        <form method='POST' action='/{{ $subject_name }}'>

            {{ csrf_field() }}

            <h1>Create a thread!</h1>
            <div class='form-group'>
                <input
                    type='text'
                    id='name'
                    name='name'
                    maxlength='30'
                    placeholder='Thread name (30 characters max)'
                    value='{{ old('name') }}'
                >
                <div class='error'>{{ $errors->first('name') }}</div>
            </div>

            <div class='form-group'>
                <textarea
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
                name='subject_id'
                value='{{ $subject_id }}'
            >

            <input
                type='hidden'
                name='subject_name'
                value='{{ $subject_name }}'
            >

            <button type='submit' class='btn btn-primary'>Create Thread!</button>

            <div class='error'>
                @if(count($errors) > 0)
                    Please correct the errors above and try again.
                @endif
            </div>

        </form>
    </div>

    <br><div class='links'>
        <a href='/'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}#bottom'>Bottom</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}'>Update</a>
    </div>

    <h1>{{ $subject_name }} threads</h1>
    <div class='cf'>
        @foreach($threads as $thread)
            <a href='/{{ $subject_name }}/thread/{{ $thread->id }}'>
                <div class='thread' id='thread{{ $thread->id }}'>
                    {{ $thread->user->name }}
                    {{ $thread->created_at }}
                    #{{ $thread->id }}<br>
                    {{ $thread->name }}: {{ $thread->text }}
                </div>
            </a>
        @endforeach
    </div>

    <br><br><div id='bottom' class='links'>
        <a href='/'>Back</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}#top'>Top</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href='/{{ $subject_name }}'>Update</a>
    </div>

@stop