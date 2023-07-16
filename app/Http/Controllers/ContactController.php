<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\EditContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::paginate(20);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Contact::STATUS;
        return view('contacts.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContactRequest $request)
    {
        $fileName = time().'_'.$request->contact_image->getClientOriginalName();
        $filePath = $request->file('contact_image')->storeAs('images', $fileName, 'public');
        $request->contact_image = '/storage/'.$filePath;

        // Contact::create($request->validated());
        Contact::create([
            'contact_name' => $request->contact_name,
            'contact_email' => $request->contact_email,
            'contact_phone_number' => $request->contact_phone_number,
            'contact_address' => $request->contact_address,
            'contact_description' => $request->contact_description,
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'status' => $request->status,
            'created_by' => $request->created_by,
            'contact_image' => $request->contact_image,
            ]);
            
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load('deals');
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $status = Contact::STATUS;
        return view('contacts.edit', compact('contact', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditContactRequest $request, Contact $contact)
    {
        if($request->hasFile('contact_image'))
        {
            $data = $contact;
            Storage::disk('public')->delete(str_replace('/storage/', '', $contact->contact_image)); //delete after removing '/storage/' part

            $fileName = time().'_'.$request->contact_image->getClientOriginalName();
            $filePath = $request->file('contact_image')->storeAs('images', $fileName, 'public');
            $data->contact_image = '/storage/'.$filePath;

            $data->update();
        }
        else
        {
            $data = $contact;
            $data->update($request->all());
        }

        return redirect()->route('contacts.show', $data)->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        abort_if(Gate::denies('delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Storage::disk('public')->delete(str_replace('/storage/', '', $contact->contact_image));

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}
