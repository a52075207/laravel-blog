<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Redis;

class Posts
{
    protected $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function all()
    {
        // return all posts

        return Post::all();
    }
}