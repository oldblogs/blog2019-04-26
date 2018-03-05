@extends ('layouts.master')

@section ('title')
  {{ $post->title }}
@endsection

@section ('content')
  <div class="col-sm-8 blog-main">
    <div class="blog-post">
      <h2 class="blog-post-title">{{ $post->title }}</h2>
      <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>

      @if (count($post->tags))
        <ul>
          @foreach ($post->tags as $tag)
            <li>
              <a href="/posts/tags/{{ $tag->name }}">
                {{ $tag->name }}
              </a>
            </li>
          @endforeach
        </ul>
      @endif

      {{ $post->body }}
      
      <hr>
      
      <div class="comments">
        <ul class="list-group">
        @foreach ($post->comments as $comment)
          
          <li class="list-group-item">
            <strong>{{ $comment->created_at->diffForHumans() }}</strong>&nbsp;
            {{ $comment->body }}
          </li>
          
        @endforeach
        </ul>
      </div>

    </div>
    
    <hr>
    
    {{-- Add a comment  --}}
    <div class="card">
      <div class="card-block">
        
        <form method="POST" action="/posts/{{ $post->id }}/comments">
          {{ csrf_field() }}
        
          <div class="form-group">
            <textarea name="body" id="" placeholder="Your comment here" cols="30" rows="10" class="form-control" required></textarea>
          </div>
          
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
          </div>
          
        </form>
        
        @include ('layouts.errors')
        
      </div>
    </div> 
    
    
  </div>
@endsection


 