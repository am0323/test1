<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index(Request $request){
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort];
        return view('player.index', $param);
    }

    public function post(Request $request) {
        $items = DB::select('select * form people');
        return view('player.index', ['items' => $items]);
    }

    public function show(Request $request) {
        $id = $request->id;
        $item = DB::table('people')->where('id', $id)->first();
        return view('player.show', ['item' => $item]);
    }

    public function add(Request $request) {
        return view('player.add');
    }

    public function create(Request $request) {
        $param = [
            'name' => $request->name,
            'date' => $request->date,
            'step' => $request->step,
            'login' => $request->login,
            'present' => $request->present,
            'rank' => $request->rank,
            'point' => $request->point
        ];
        DB::insert('insert into people (name, date, step, login, present, rank, point) values (:name, :date, :step, :login, :present, :rank, :point)', $param);
        return redirect('/player?sort=id');
    }

    public function edit(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('player.edit', ['form' => $item[0]]);
    }

    public function update(Request $request) {
        $param = [
            'id' => $request->id,
            'name' => $request->name,
            'date' => $request->date,
            'step' => $request->step,
            'login' => $request->login,
            'present' => $request->present,
            'rank' => $request->rank,
            'point' => $request->point
        ];
        DB::update('update people set name = :name, date = :date, step = :step, login = :login, present = :present, rank = :rank, point = :point where id = :id', $param);
        return redirect('/player?sort=id');
    }

    public function del(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from people where id = :id', $param);
        return view('player.del', ['form' => $item[0]]);
    }

    public function remove(Request $request) {
        $param = ['id' => $request->id];
        DB::delete('delete from people where id = :id', $param);
        return redirect('/player?sort=id');
    }

    public function getAuth(Request $request) {
        $param = ['message' => 'ログインしてください。'];
        return view('person.auth', $param);
    }

    public function postAuth(Request $request) {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            $msg = 'ログインしました。(' . Auth::user()->name . ')';
        } else {
            $msg = 'ログインに失敗しました。';
        }
        return view('person.auth', ['message' => $msg]);
    }
}
