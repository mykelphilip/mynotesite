<?php

namespace App\Http\Controllers;


use App\Models\Note;
use Illuminate\Http\Request;

class noteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $notes = Note::query()
        ->where('user_id', auth()->check() ? auth()->user()->id : null)// Handle non-authenticated case    
        ->orderBy('created_at', 'desc')
        ->paginate(16);
        return view('note.index', ['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() 
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $data['user_id']= $request->user()->id;
        $note = Note::create($data);
        return to_route('note.show', $note)->with('message', 'Note was created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if (!auth()->check() ? auth()->user()->id : null) {
            abort(403);
        }
        return view('note.show', ['note'=> $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        $notes = Note::query();
        return view('note.edit', ['note'=> $note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note -> update($data);
        return to_route('note.show', $note)->with('message', 'Note was Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note -> delete();
        return to_route('note.index', $note)->with('message', 'Note was Deleted');
    }
}
