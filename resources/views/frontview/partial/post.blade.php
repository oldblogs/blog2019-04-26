
<div class="card flex-md-row mb-4 box-shadow h-md-250">
  <div class="card-body d-flex flex-column align-items-start">
    <h3 class="mb-0">
      <a class="text-dark" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
    </h3>
    <strong class="d-inline-block mb-2 text-success">Design</strong>
    <div class="mb-1 text-muted">{{ $post->created_at->toFormattedDateString() }}</div>
      {{--
        // From Carbon document
        $dt->toDateString();        // 1975-12-25
        $dt->toFormattedDateDtring  // Dec 25, 1975
        $dt->toTimeString           // 14:15:16
        $dt->toDateTimeString       // 1975-12-25 14:15:16
        $dt->toDayDateTimeString    // Thu, Dec 25, 1975 2:15 PM
        $dt->format('l jS \\of F Y h:i:s A');  // Thursday, 25th of December 1975 02:15:16 PM
      --}}
    <p class="card-text mb-auto">{{ $post->body }}</p>
    
    <a href="/posts/{{ $post->id }}">Continue reading</a>
  </div>
</div>

