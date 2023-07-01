<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Show main page.
     */
    public function index(Request $request)
    {
        $items = [];
        switch ($request->sortType) {
            case 'incId':
                $items = Item::orderBy('id')->get();
                break;
            case 'decId':
                $items = Item::orderByDesc('id')->get();
                break;
            case 'alphabet':
                $items = Item::orderBy('body')->get();
                break;
            case 'invAlphabet':
                $items = Item::orderByDesc('body')->get();
                break;
            default:
                $items = Item::all();
                break;
        }
        return view('index', ['items' => $items, 'sortType' => $request->sortType]);
    }

    /**
     * Save a new item.
     */
    public function store(Request $request)
    {
        if (!$request->body) {
            return abort(400);
        }

        $item = new Item();
        $item->body = $request->body;
        $item->save();

        return;
    }

    /**
     * Update the specified item from storage.
     */
    public function update(Request $request)
    {
        if (!$request->id || !$request->newBody) {
            return abort(400);
        }

        $item = Item::find($request->id);

        if (!$item) {
            return abort(400);
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
        if (!$request->id) {
            return abort(400);
        }

        $item = Item::find($request->id);

        if (!$item) {
            return abort(400);
        }

        $item->delete();

        return;
    }
}
