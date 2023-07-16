<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'cost' => 'required|numeric|gt:0',
                'price' => 'required|numeric|gt:'.$request->cost,
            ],
            ['price.gt' => 'The price field must be greater than cost']
        );

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Item created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'required',
                'cost' => 'required|numeric|gt:0',
                'price' => 'required|numeric|gt:'.$request->cost,
            ],
            ['price.gt' => 'The price field must be greater than cost']
        );

        $data = $item;
        $data->update($validated);

        return redirect()->route('items.index')->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully');
    }
}
