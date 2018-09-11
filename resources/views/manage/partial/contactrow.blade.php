<tr>
    <td>{{ $contact->id }}</td>
    <td>{{ $contact->title }}</td>
    <td>{{ $contact->created_at->toFormattedDateString() }}</td>
    <td>{{ $contact->updated_at->toFormattedDateString() }}</td>
    <td><a class="btn btn-sm btn-outline-secondary" role="button" href="{{ route('contacts.show', $contact) }}"><span data-feather="book-open"></span></a></td>
    <td>
        <a class="btn btn-sm btn-outline-secondary" role="button" 
        href="{{ route('contacts.edit', $contact) }}" ><span data-feather="edit-3"></span></a>
    </td>
    <td>
        <form method="POST" action="{{ route('contacts.delete',$contact) }}">
          @method('DELETE')
          @csrf
          <input type="hidden" name="id" value="{{$contact->id}}" >
          <button type="submit" class="btn btn-sm btn-outline-secondary"><span data-feather="trash-2"></span></button>
        </form>
    </td>
</tr>
