@extends('layouts.master')

@section('content')
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>

        {{ $post->body }}
    </div>

    <hr>

    @if(count($post->comments))
        <div class="comments">
            <ul class="list-group">
                @foreach($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>
                            {{ $comment->created_at->setTimezone('Asia/Taipei')->diffForHumans() }} :&nbsp;
                        </strong>
                        {{ $comment->body }}
                    </li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endif

    {{-- Add a comment --}}
    <div class="carf">
        <div class="card-block">
            <form action="/posts/{{ $post->id }}/comments" method="POST">
                @csrf
                {{-- {{ method_field('PATCH') }} --}}

                <textarea name="body" placeholder="Leave your comment" class="form-control"></textarea>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add comment</button>
                </div>

            </form>
        </div>
        @include('layouts.errors')
    </div>
@endsection
