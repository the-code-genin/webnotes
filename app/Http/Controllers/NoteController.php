<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class NoteController extends Controller
{
    protected $response = [
        'ok' => false,
        'message' => '',
        'data' => [
            'reload' => false,
            'redirect' => null
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        return view('index', ['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $this->getValidationFactory()->make($request->all(), [
            'title' => 'required|unique:notes,title',
            'content' => 'required',
        ]);

        if ($valid->fails()) {
            $this->response['message'] = $valid->getMessageBag()->first();
            return $this->response;
        }

        $note = new Note;
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        $this->response['ok'] = true;
        $this->response['message'] = 'Note created successfully';
        $this->response['data']['redirect'] = route('notes.edit', $note);
        return $this->response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('reader', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('editor', ['note' => $note]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $valid = $this->getValidationFactory()->make($request->all(), [
            'title' => 'required|unique:notes,title,' . $note->id,
            'content' => 'required',
        ]);

        if ($valid->fails()) {
            $this->response['message'] = $valid->getMessageBag()->first();
            return $this->response;
        }

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        $this->response['ok'] = true;
        $this->response['message'] = 'Note updated successfully';
        return $this->response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return array
     */
    public function destroy(Note $note)
    {
        $note->delete();
        $this->response['ok'] = true;
        $this->response['message'] = 'Note deleted successfully';
        $this->response['data']['reload'] = true;
        return $this->response;
    }
}
