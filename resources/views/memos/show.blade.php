@extends('layouts.app')

@section('content')
<a href="/memos" class="btn btn-default">Go Back</a>
<h1>{{$memo->title}}</h1>
<div>
    {!!$memo->body!!}
</div>
<hr>
<small>Added on {{$memo->created_at}} by {{$memo->user->name}}</small>
<hr>
@if(!Auth::guest())
    @if(Auth::user()->id == $memo->user_id)
<a href="/memos/{{$memo->id}}/edit" class = "btn btn-default">Edit</a>

{!! Form::open(['action' => ['MemosController@delete', $memo->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
{{Form::hidden('_method', 'GET')}}
{{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
{!! Form::close() !!}
@endif
@endif
@endsection