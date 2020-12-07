<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlowerController extends Controller
{
    public function index(Request $request) {
        $items = DB::select('select * from flowers');
        return view('flower.index',['items' => $items]);
    }

    public function show(Request $request) {
        $id = $request->id;
        $item = DB::table('flowers')->where('id', $id)->first();
        return view('flower.show', ['item' => $item]);
    }

    public function edit(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from flowers where id = :id',$param);
        return view('flower.edit',['form' => $item[0]]);
    }

    public function update(Request $request) {
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'detail' => $request->detail,
            'word' => $request->word,
        ];
        DB::update('update flowers set name = :name, detail = :detail, word = :word where id = :id', $param);
        return redirect('/flower');
    }
}
