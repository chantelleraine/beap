@extends('layouts.app')

@section('content')
    <a href="/beap/public/illustrationposts" class="btn btn-default">Go back</a>
    <div class="well">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h1>{{$illustration->name}}</h1>
                <img style="width:40%" src="{{ asset('illustrationImage/' . $illustration->image) }}"/>
            </div>
            <div class="col-md-6 col-sm-6">
                {!!$illustration->description!!}
            </div>
            <hr>
            <small>Written on {{$illustration->created_at}}</small>
            <hr>
            <a href="/beap/public/illustrationposts/{{$illustration->id}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action' => ['IllustrationsController@show', $illustration->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection