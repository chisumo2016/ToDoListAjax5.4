<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ListController extends Controller
{
    //
    public function index()
    {
        $items = Item::all();
       return view('list', compact('items'));
    }

    public function create(request $request)
    {
        $item = new Item;
        $item->item = $request->text;
        $item->save();
        return 'Done';
       //return $request->all();
    }

    public  function  delete(Request $request)
    {
        Item::where('id', $request->id)->delete();
        return $request->all();
    }

    public function  update(Request $request)
    {
        $item = Item::find($request->id);
        $item->item = $request->value;
        $item->save();
        return $request->all();
    }
}
