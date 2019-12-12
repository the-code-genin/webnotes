@extends('layouts.app')

{{-- Page content --}}
@section('content')

    <article class="card shadow">
        <div class="card-header">
            <h3 id="editor_title">@if (isset($note)) Edit Note @else Create Note @endif</h3>
        </div>

        <form action="@if (!isset($note)) {{route('notes.store')}} @else {{route('notes.update', ['note' => $note->id])}} @endif" method="POST"
            class="card-body" id="editor_form">

            <div class="form-group">
                <input type="text" name="title" placeholder="Note Title" class="form-control" required="true" @if (isset($note)) value="{{$note->title}}" @endif/>
            </div>

            <div class="form-group">
                <textarea id="ckeditor" name="content" placeholder="Note Content" rows="10" class="form-control" required="true">@if (isset($note)){{$note->content}}@endif</textarea>
            </div>

        </form>

        <div class="card-footer">
            <button type="button" id="save_note_btn" class="btn btn-success">Save</button>
            <button type="button" id="discard_note_btn" data-url="{{ url()->previous() }}" class="btn btn-danger">Discard</button>
        </div>
    </article>

@endsection