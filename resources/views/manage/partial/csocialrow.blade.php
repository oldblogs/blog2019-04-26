@can('show','App\Csocial')
<tr>
  
    <td>{{ $csocial->id }}</td>
    <td>{{ $csocial->title }}</td>
    <td>{{ $csocial->created_at->toFormattedDateString() }}</td>
    <td>{{ $csocial->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('csocials.show', $csocial) }}"><span data-feather="book-open"></span></a></td>

    <td>
      @can('edit','App\Csocial')
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('csocials.edit', $csocial) }}" ><span data-feather="edit-3"></span></a>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="edit-3"></span></button>  
      @endcan
    </td>
    
    <td>
      @can('delete','App\Csocial')
        <form method="POST" action="{{ route('csocials.delete',$csocial) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$csocial->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="trash-2"></span></button>
      @endif
    </td>
  
</tr>
@endcan

