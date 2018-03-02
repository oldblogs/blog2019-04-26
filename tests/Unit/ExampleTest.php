<?php

namespace Tests\Unit;

use App\Post;
use Tests\TestCase;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends TestCase
{
    use DatabaseTransactions ;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Given I have two records in the database that are posts,
        // and each one is posted a month apart.
        $first = factory(Post::class)->create();
        $second = factory(Post::class)->create([
            'created_at' => \Carbon\Carbon::now()->subMonth()
        ]);
        
        // When I fetch the archives.
        $posts = Post::archives();
        
        // Then the response should be in the proper format.
        $this->assertEquals([
            [
                // not
                // "year" => $first->created_at->format('Y'),
                "year" => $first->created_at->year,
                "month" => $first->created_at->format('F'),
                "published" => 1
            ],
            [
                // not
                // "year" => $second->created_at->format('Y'),
                "year" => $second->created_at->year,
                "month" => $second->created_at->format('F'),
                "published" => 1
            ]
        ], $posts );
    }
}
