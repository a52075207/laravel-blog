@extends('layouts.master')

@section('content')
    <p>Adding a post    </p>
    <hr>
    <form action="/posts" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" class="form-control" ><br>
        </div>

        <div class="form-group">
            <label for="body">Body:</label><br>
            <textarea id="body" name="body" class="form-control" ></textarea><br>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
        </div>

        @include('layouts.errors')
    </form>
@endsection
