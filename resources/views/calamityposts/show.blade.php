@extends('layouts.app')

@section('content')
    <a href="/beap/public/calamityposts" class="btn btn-default">Go back</a>
    <div class="well">
        <div class="row">
            <div class="col-md-6 col-sm-6">
    <h1>{{$calamity->name}}</h1>
    <img style="width:40%" src="{{ asset('calamityImage/' . $calamity->image) }}"/>
            </div>
            <div class="col-md-6 col-sm-6">
        {!!$calamity->description!!}
            </div>
    <hr>
    <small>Written on {{$calamity->created_at}}</small>
    <hr>
    <a href="/beap/public/calamityposts/{{$calamity->id}}/edit" class="btn btn-default">Edit</a>

    {!!Form::open(['action' => ['CalamitiesController@show', $calamity->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!!Form::close()!!}
@endsection