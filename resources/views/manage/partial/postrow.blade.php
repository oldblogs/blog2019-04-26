<tr>
  <td>{{ $post->id }}</td>
  <td>{{ $post->title }}</td>
  <td>{{ $post->created_at->toFormattedDateString() }}</td>
  <td>{{ $post->updated_at->toFormattedDateString() }}</td>
  <td><a class="btn btn-sm btn-outline-secondary" role="button" href="/posts/{{ $post->id }}"  target="_blank"><span data-feather="book-open"></span></a></td>
  <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('getposteditform', $post) }}" ><span data-feather="edit-3"></span></a></td>
  <td>
    <form method="POST" action="{{ route('deletepost',$post) }}">
      @method('DELETE')
      @csrf
      <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
    </form>
  </td>

</tr>