<?php 

namespace App\Providers;

use App\Medium;
use App\Redis;
use Illuminate\Support\Facades\DB;

class MediaRepository{
  protected $redis;

  public function __construct(Redis $redis){
    $this->redis = $redis;
  }

  public function all(){
    return Medium::all();
  }

  public function latest(){
    // TODO: User input validation
    return $media = Media::latest()->filter(request(['month', 'year']));
  }

  public function paginated(){
    $mpp = (int)config('app.media_per_page', 10);
    return $media = Media::latest()->paginate($mpp);
  }
}