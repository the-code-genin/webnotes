<a href="{{ route('notes.edit', $note->id) }}" class="text text-inline-block text-success">Edit</a> &nbsp;
<form action="{{route('notes.destroy', $note->id) }}" class="ajax-form inline-lock d-none" method="POST">{{ csrf_field() }}{{ method_field('DELETE') }}</form> &nbsp;
<a href="javascript:(0)" class="text text-inline-block text-danger">Delete</a> &nbsp;