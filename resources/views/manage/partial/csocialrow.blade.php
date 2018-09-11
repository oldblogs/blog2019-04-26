<tr>
    <td>{{ $csocial->id }}</td>
    <td>{{ $csocial->title }}</td>
    <td>{{ $csocial->created_at->toFormattedDateString() }}</td>
    <td>{{ $csocial->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('csocials.show', $csocial) }}"><span data-feather="book-open"></span></a></td>
    <td>
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('csocials.edit', $csocial) }}" ><span data-feather="edit-3"></span></a>
    </td>
    <td>
        <form method="POST" action="{{ route('csocials.delete',$csocial) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$csocial->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
    </td>
</tr>
