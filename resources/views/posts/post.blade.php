<div class="blog-post">

  {{--
    // From Carbon document
    $dt->toDateString();        // 1975-12-25
    $dt->toFormattedDateDtring  // Dec 25, 1975
    $dt->toTimeString           // 14:15:16
    $dt->toDateTimeString       // 1975-12-25 14:15:16
    $dt->toDayDateTimeString    // Thu, Dec 25, 1975 2:15 PM
    $dt->format('l jS \\of F Y h:i:s A');  // Thursday, 25th of December 1975 02:15:16 PM
  --}}
  
  <h2 class="blog-post-title"> 
    <a href="/posts/{{ $post->id }}">
      {{ $post->title }}
    </a>
  </h2>
  
  <p class="blog-post-meta">
    {{ $post->user->name }} on
    {{ $post->created_at->toFormattedDateString() }}
  </p>

  {{ $post->body }}

</div><!-- /.blog-post -->
