<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

    public function scopeFilter($query, $filters)
    {
        if (! $filters) {
            return;
        }

        if ($month = $filters['month'])
        {
            $query->whereMonth('created_at', Carbon::parse($month)->month); // March -> 3, April -> 4
        }

        if ($year = $filters['year'])
        {
            $query->whereYear('created_at', $year);
        }
    }

    public static function archives()
    {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) publish')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }
}
