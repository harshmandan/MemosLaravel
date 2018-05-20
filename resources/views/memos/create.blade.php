@extends('layouts.app')

@section('content')
<a href="/memos" class="btn btn-default">Go Back</a>
<h1>Add new memo</h1>
{!! Form::open(['action' => 'MemosController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Enter a title for your memo'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Content')}}
        {{Form::textarea('body', '', ['id'=>'article-ckeditor','class' => 'form-control', 'placeholder' => 'Your memo goes here'])}}
    </div>
    {{Form::submit('Submit', ['class'=> 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection