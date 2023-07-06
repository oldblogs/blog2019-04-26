<tr>
    <td>{{ $csocial->id }}</td>
    <td>{{ $csocial->title }}</td>
    <td>{{ $csocial->created_at->toFormattedDateString() }}</td>
    <td>{{ $csocial->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('csocials.show', $csocial) }}"><i class="fa-solid fa-book-open-reader"></i></a></td>
    <td>
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('csocials.edit', $csocial) }}" ><i class="fa-solid fa-pencil"></i></a>
    </td>
    <td>
        <form method="POST" action="{{ route('csocials.delete',$csocial) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$csocial->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-trash-can"></i></button>
        </form>
    </td>
</tr>
