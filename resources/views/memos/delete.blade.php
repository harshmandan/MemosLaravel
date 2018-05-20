@extends('layouts.app')

@section('content')
<div class = "well">
<h1>{{$memo->title}}</h1>
<div>
    {!!$memo->body!!}
</div>
</div>
<hr>
<small>Added on {{$memo->created_at}} by {{$memo->user->name}}</small>
<hr>
<large>Are you sure you want to delete this memo?</large>
<br>
<div class="btn-toolbar">
<div class="btn-group"> <a href="/memos/" class = "btn btn-default">No</a> </div>
<div class="btn-group">
{!! Form::open(['action' => ['MemosController@destroy', $memo->id], 'method' => 'POST']) !!}
{{Form::submit('Yes', ['class' => 'btn btn-danger'])}}
{{Form::hidden('_method', 'DELETE')}}
{!! Form::close() !!}
</div>
</div>
@endsection