<article class="blog-post">

    <h2 class="blog-post-title mb-1">
        <a href="posts/{{$post->id}}">
            {{ $post->title }}
        </a>
    </h2>

    <p class="blog-post-meta">
        {{ $post->created_at->timezone('Asia/Taipei')->toFormattedDayDateString() }}
    </p>

    <p>
        {{ $post->body }}
    </p>

</article>
