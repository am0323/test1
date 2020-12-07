<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentController extends Controller
{
    public function index(Request $request){
        $items = DB::select('select * from presents');
        return view('present.index',['items' => $items]);
    }

    public function post(Request $request) {
        $items = DB::select('select * form presents');
        return view('present.index', ['items' => $items]);
    }

    public function show(Request $request) {
        $id = $request->id;
        $item = DB::table('presents')->where('id', $id)->first();
        return view('present.show', ['item' => $item]);
    }

    public function add(Request $request) {
        return view('present.add');
    }

    public function create(Request $request) {
        $param = [
            'id' => $request->id,
            'season' => $request->season,
            'seed' => $request->seed,
            'bud' => $request->bud,
            'grow' => $request->grow,
            'flower' => $request->flower,
        ];
        DB::insert('insert into presents (season, seed, bud, grow, flower) values (:season, :seed, :bud, :grow, :flower)', $param);
        return redirect('/present');
    }

    public function edit(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from presents where id = :id', $param);
        return view('present.edit', ['form' => $item[0]]);
    }

    public function update(Request $request) {
        $param = [
            'id' => $request->id,
            'season' => $request->season,
            'seed' => $request->seed,
            'bud' => $request->bud,
            'grow' => $request->grow,
            'flower' => $request->flower,
        ];
        DB::update('update presents set season = :season, seed = :seed, bud = :bud, grow = :grow, flower = :flower where id = :id', $param);
        return redirect('/present');
    }

    public function del(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from presents where id = :id', $param);
        return view('present.del', ['form' => $item[0]]);
    }

    public function remove(Request $request) {
        $param = ['id' => $request->id];
        DB::delete('delete from presents where id = :id', $param);
        return redirect('/present');
    }
}
