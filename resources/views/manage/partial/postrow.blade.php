<tr>
  <td>{{ $post->id }}</td>
  <td>{{ $post->title }}</td>
  <td>{{ $post->created_at->toFormattedDateString() }}</td>
  <td>{{ $post->updated_at->toFormattedDateString() }}</td>
  <td>
    @if ($post->published) 
      <span class="badge badge-success">Yes</span> 
    @else 
      <span class="badge badge-secondary">No</span> 
    @endif
  </td>
  <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('manage_view_post', $post) }}"><span data-feather="book-open"></span></a></td>
  <td>
    <a class="btn btn-sm btn-outline-secondary" role="button" 
      href="{{ route('get_post_edit_form', $post) }}" ><span data-feather="edit-3"></span></a>
  </td>
  <td>
    <form method="POST" action="{{ route('delete_post',$post) }}">
      @method('DELETE')
      @csrf
      <input type="hidden" name="id" value="{{$post->id}}" >
      <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
    </form>
  </td>
</tr>

