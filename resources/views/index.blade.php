@extends('layouts.app')

@section('content')

    {{-- Link to create a new web note --}}
    <a href="{{ route('create') }}" class="btn btn-success btn-block">Create New Web Note</a>

    {{-- Render the web notes --}}
    @if (count($notes) > 0)
        @each('layouts.note', $notes, 'note')
    @else
        <p class="d-3 text-center my-3">Be the first to write a web note!</p>
    @endif

    {{-- Render the page links --}}
    {{ $notes->links('vendor.pagination.bootstrap-4') }}

@endsection