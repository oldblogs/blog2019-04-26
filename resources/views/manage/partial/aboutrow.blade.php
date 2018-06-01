<tr>
  @can('show',$about)
    <td>{{ $about->id }}</td>
    <td>{{ $about->title }}</td>
    <td>{{ $about->created_at->toFormattedDateString() }}</td>
    <td>{{ $about->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('abouts.show', $about) }}"><span data-feather="book-open"></span></a></td>

    <td>
      @can('edit',$about)
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('abouts.edit', $about) }}" ><span data-feather="edit-3"></span></a>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="edit-3"></span></button>  
      @endcan
    </td>
    
    <td>
      @can('delete',$about)
        <form method="POST" action="{{ route('abouts.delete',$about) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$about->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="trash-2"></span></button>
      @endcan
    </td>
  @endcan
</tr>

