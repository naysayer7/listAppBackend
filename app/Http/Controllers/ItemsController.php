<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemsController extends Controller
{
    /**
     * Show main page.
     */
    public function index(Request $request)
    {
        $validator = $request->validate([
            'sortField' => Rule::in(['id', 'body']),
            'sortOrder' => Rule::in(['asc', 'desc'])
        ]);

        $items = Item::where('user_id', $request->user()->id);

        if ($request->sortField)
            $items = $items->orderBy($request->sortField, $request->sortOrder ? $request->sortOrder : 'asc');

        return view('index', [
            'items' => $items->get(),
            'sortOrder' => $request->sortOrder,
            'sortField' => $request->sortField
        ]);
    }

    public function show(Request $request) {
        return Item::where('user_id', $request->user()->id)->get();
    }

    /**
     * Save a new item.
     */
    public function store(StoreItemRequest $request)
    {
        $validator = $request->validated();
        Item::create(['body' => $request->body, 'user_id' => $request->user()->id]);
        return [];
    }

    /**
     * Update the specified item from storage.
     */
    public function update(UpdateItemRequest $request)
    {
        $validator = $request->validated();

        $item = Item::find($request->id);
        $item->body = $request->newBody;
        $item->save();

        return [];
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(DestroyItemRequest $request)
    {
        $validator = $request->validated();

        $item = Item::find($request->id);
        $item->delete();

        return [];
    }
}
