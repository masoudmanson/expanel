@extends('app')

@section('content')
    <h1>create gallery</h1>
    <br>
    <form action="/gallery" method="post" enctype="multipart/form-data">

        {{csrf_field()}}

        <div class="form-group">
            <label for="usr">Title:</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="pwd">Description:</label>
            <textarea type="text" class="form-control" name="description" id="description"></textarea>
        </div>

        <input type="file" name="img" id="img">
        <input type="file" name="vid" id="vid">

        <button type="submit">save</button>
    </form>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@stop