<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            'sortOrder' => Rule::in(['ascending', 'descending'])
        ]);

        $items = Item::where('user_id', $request->user()->id);

        if ($request->sortField)
            if ($request->sortOrder == 'descending') {
                $items = $items->orderByDesc($request->sortField);
            } else {
                $items = $items->orderBy($request->sortField);
            }

        return view('index', [
            'items' => $items->get(),
            'sortOrder' => $request->sortOrder,
            'sortField' => $request->sortField
        ]);
    }

    /**
     * Save a new item.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'body' => 'required'
        ]);

        Item::create(['body' => $request->body, 'user_id' => $request->user()->id]);
        return;
    }

    /**
     * Update the specified item from storage.
     */
    public function update(Request $request)
    {
        $validator = $request->validate([
            'id' => ['required', 'exists:items,id'],
            'newBody' => ['required']
        ]);

        $item = Item::find($request->id);

        if (!Gate::allows('edit-item', $item)) {
            abort(403);
        }

        $item->body = $request->newBody;

        $item->save();

        return;
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(Request $request)
    {
        $validator = $request->validate([
            'id' => ['required', 'exists:items,id'],
        ]);

        $item = Item::find($request->id);

        if (!Gate::allows('remove-item', $item)) {
            abort(403);
        }

        $item->delete();

        return;
    }
}
