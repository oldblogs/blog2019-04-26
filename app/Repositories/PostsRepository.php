<?php

namespace App\Repositories;

use App\Post;
use App\Redis;
use Illuminate\Support\Facades\DB;

class PostsRepository
{
  protected $redis;
  
  public function __construct(Redis $redis)
  {
    $this->redis = $redis;
  }
  
  public function all()
  {
    return Post::all();
  }
  
  public function latest()
  {
    // TODO: User input validation
    return $posts = Post::latest()->filter(request(['month', 'year']));
  }
  
  public function paginated()
  {
    $ppp = (int)config('app.posts_per_page', 10);

    return $posts = Post::latest()->paginate($ppp);
  }

  public function mainpage()
  {
    $ppp = (int)config('app.posts_in_mainpage', 3);

    return $posts = Post::latest()->limit($ppp)->get();
  }

}

