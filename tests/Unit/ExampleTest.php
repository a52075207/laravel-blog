<?php

namespace Tests\Unit;

use App\Models\Post;

use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    // When transaction was executing completely
    // The data will rollback to the clean status
    use DatabaseTransactions;
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        // Given I have 2 records in the database that are posts.

        // and each one is posted a month apart.

        $first = Post::factory()->create();

        $second = Post::factory()->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        // When I fetch the archives;
        $posts = Post::archives();
        // Then the response should be in the proper format

        $this->assertEquals([
            [
                "year" => $first->created_at->format('Y'),
                "month" => $first->created_at->format('F'),
                "publish" => 1
            ],
            [
                "year" => $second->created_at->format('Y'),
                "month" => $second->created_at->format('F'),
                "publish" => 1
            ]
        ], $posts);
    }
}
