@can('show','App\Contact')
<tr>
  
    <td>{{ $contact->id }}</td>
    <td>{{ $contact->title }}</td>
    <td>{{ $contact->created_at->toFormattedDateString() }}</td>
    <td>{{ $contact->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('contacts.show', $contact) }}"><span data-feather="book-open"></span></a></td>

    <td>
      @can('edit','App\Contact')
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('contacts.edit', $contact) }}" ><span data-feather="edit-3"></span></a>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="edit-3"></span></button>  
      @endcan
    </td>
    
    <td>
      @can('delete','App\Contact')
        <form method="POST" action="{{ route('contacts.delete',$contact) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$contact->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
      @else
        <button class="btn btn-sm btn-outline-secondary disabled"><span data-feather="trash-2"></span></button>
      @endif
    </td>
  
</tr>
@endcan

