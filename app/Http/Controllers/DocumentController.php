<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::paginate(20);
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'details' => 'required',
                'file_path' => 'required|file|max:4096',
            ],
            ['file_path.max' => 'The file must not be greater than 4 MB.']
        );

        $fileName = time().'_'.$request->file_path->getClientOriginalName();
        $filePath = $request->file('file_path')->storeAs('documents', $fileName, 'public');
        $request->file_path = '/storage/'.$filePath;

        Document::create([
            'details' => $request->details,
            'file_path' => $request->file_path,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        Storage::disk('public')->delete(str_replace('/storage/', '', $document->file_path));

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully');
    }

    public function download($id)
    {
        $filePath = Document::where('id', $id)->value('file_path');

        return Storage::disk('public')->download(str_replace("/storage/", "", $filePath));
    }
}
