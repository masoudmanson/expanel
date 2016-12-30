@extends('app')

@section('content')
    <h1>My Gallery</h1>
    <br>
    @foreach($gallery as $photo)

        <h3>{{$photo->title}}</h3>
        <p>{{$photo->description}}</p>
    @endforeach

@stop