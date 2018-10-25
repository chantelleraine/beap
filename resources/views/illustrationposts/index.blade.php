@extends('layouts.app')

@section('content')
    <br/>
    @if(count($illustrations) > 0)
        @foreach($illustrations as $illustration)
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <img style="width:40%" src="{{ asset('illustrationImage/'.$illustration->image)}}">
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <h3><a href="/beap/public/illustrationposts/{{$illustration->id}}">{{$illustration->name}}</a></h3>
                        <small>Written on {{$illustration->created_at}}</small>
                    </div>
                </div>
            </div>



        @endforeach
        {{$illustrations->links()}}
    @else
        <p>No illustrations found.</p>
    @endif
@endsection