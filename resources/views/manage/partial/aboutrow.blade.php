<tr>
    <td>{{ $about->id }}</td>
    <td>{{ $about->title }}</td>
    <td>{{ $about->created_at->toFormattedDateString() }}</td>
    <td>{{ $about->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('abouts.show', $about) }}"><span data-feather="book-open"></span></a></td>
    <td>
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('abouts.edit', $about) }}" ><span data-feather="edit-3"></span></a>
    </td>
    <td>
        <form method="POST" action="{{ route('abouts.delete',$about) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$about->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
    </td>
</tr>

