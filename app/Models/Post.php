<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'body', 'user_id' ];

    // protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addComment($body)
    {
        // Comment::create([
        //     'body'=> $body,
        //     'post_id'=>$this->id
        // ]);

        $this->comments()->create([
            'body'    => $body,
            'user_id' => auth()->user()->id
        ]);
        // $comment = new Comment;
        // $comment->post_id = $this->id;
        // $comment->user_id = auth()->user()->id;
        // $comment->body = $body;
        // $comment->save();
    }
}
