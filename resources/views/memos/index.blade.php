@extends('layouts.app')

@section('content')
<h1>My Memos</h1>
@if(count($memos)>0)
    @foreach($memos as $memo)
    <div class = "well">
        <h3><a href = "/memos/{{$memo->id}}">{{$memo->title}}</a></h3>
        <small>Added on {{$memo->created_at}} by {{$memo->user->name}}</small>
    </div>
    @endforeach
    {{$memos->links()}}
@else
    <p>No memos added yet!</p>
@endif
@endsection