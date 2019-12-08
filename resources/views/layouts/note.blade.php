<article class="card shadow-sm my-3">

    <div class="card-body">
        <a href="{{ route('show', $note->id) }}" class="text text-primary d-3 card-title">{{ $note->title }}</p>
    </div>

    <div class="card-footer">
        @include('layouts.action', ['note' => $note])
    </div>

</article>