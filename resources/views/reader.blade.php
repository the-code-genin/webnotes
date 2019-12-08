@extends('layouts.app')

@section('content')
    <article class="card">

        <div class="card-header">
            <h2>{{ $note->title }}</h2>
        </div>

        <div class="card-body">
            <p class="card-text lead">{{ $note->content }}</p>
        </div>

        <div class="card-footer">
            @include('layouts.action', ['note' => $note])
            <a href="{{ url()->previous() }}" class="text text-inline-block text-primary">Back</a>
        </div>

    </article>
@endsection