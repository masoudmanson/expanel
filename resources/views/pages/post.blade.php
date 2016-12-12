@extends('app')

@section('content')
<h1>My Posts</h1>
<br>
    @foreach($posts as $post)

        <h3>{{$post->title}}</h3>
        <p>{{$post->description}}</p>
    @endforeach

@stop