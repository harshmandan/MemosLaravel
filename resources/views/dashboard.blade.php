@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  <h3>Your Memos</h3> 
                  @if(count($memos)>0)
                  <table class="table table-striped">
                      <tr>
                          <th>Title</th>
                          <th></th>
                          <th></th>
                          
                      </tr>
                      @foreach($memos as $memo)
                        <tr>
                            <td><a href = "/memos/{{$memo->id}}/">{{$memo->title}}</a></td>
                            <td><a href="/memos/{{$memo->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>
                                    {!! Form::open(['action' => ['MemosController@delete', $memo->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
                                    {{Form::hidden('_method', 'GET')}}
                                    {{Form::submit('Delete', ['class'=> 'btn btn-danger'])}}
                                    {!! Form::close() !!}
                            </td>
                        </tr>
                      @endforeach
                  </table>
                  @else
                    <p>You have no memos</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
