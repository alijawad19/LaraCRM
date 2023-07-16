<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\DealItem;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::with('contact')->paginate(20);

        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contacts = Contact::get(['id', 'contact_name']);
        $users = User::get(['id', 'name']);
        $items = Item::all();
        $status = Deal::STATUS;

        return view('deals.create', compact('contacts', 'users', 'items', 'status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "contact_id" => 'required|numeric',
            "owner_id" => 'required|numeric',
            "deal_amount" => 'required|numeric',
            "deal_items" => 'required',
            "note" => 'required',
            "closed_on" => 'required',
            "status" => 'required',
        ]);

        $created_on = Carbon::now()->format('Y-m-d');

        $dealItems = $request->deal_items;

        $deal = Deal::create([
            "name" => $request->name,
            "contact_id" => $request->contact_id,
            "owner_id" => $request->owner_id,
            "deal_amount" => $request->deal_amount,
            "note" => $request->note,
            "created_on" => $created_on,
            "closed_on" => $request->closed_on,
            "status" => $request->status,
        ]);
        
        foreach($dealItems as $dealItem)
        {
            
            $dealItem = [
                'deal_id' => $deal->id,
                'item_id' => $dealItem,
            ];

            DealItem::create($dealItem);
        }
                
        return redirect()->route('deals.index')->with('success', 'Deal created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $deal->load('deal_items');
        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $contacts = Contact::get(['id', 'contact_name']);
        $users = User::get(['id', 'name']);
        $items = Item::all();
        $status = Deal::STATUS;
        $deal->with('deal_items');
        return view('deals.edit', compact('deal', 'contacts', 'users', 'items', 'status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            "name" => 'required',
            "contact_id" => 'required|numeric',
            "owner_id" => 'required|numeric',
            "deal_amount" => 'required|numeric',
            "deal_items" => 'required',
            "note" => 'required',
            "closed_on" => 'required',
            "status" => 'required',
        ]);

        $validated = $request->except('deal_items');
        $deal->update($validated);

        DealItem::where('deal_id', $deal->id)->delete();

        $dealItems = $request->deal_items;

        foreach($dealItems as $dealItem)
        {
            
            $dealItem = [
                'deal_id' => $deal->id,
                'item_id' => $dealItem,
            ];

            DealItem::create($dealItem);
        }
        
        return redirect()->route('deals.index')->with('success', 'Deal updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();

        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully');
    }
}
