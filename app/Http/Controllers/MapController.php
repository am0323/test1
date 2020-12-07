<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MapRequest;
use Validator;

class MapController extends Controller
{
    public function index(Request $request) {
        $items = DB::select('select * from maps');
        return view('map.index',['items' => $items]);
    }

    public function post(MapRequest $request) {
        return view('map.index', ['msg' => '正しく入力されました!']);
    }

    public function show(Request $request) {
        $id = $request->id;
        $item = DB::table('maps')->where('id', $id)->first();
        return view('map.show', ['item' => $item]);
    }

    public function add(Request $request) {
        return view('map.add');
    }

    public function create(Request $request) {
        $param = [
            'photo' => $request->photo,
            'date' => $request->date,
            'area' => $request->area,
        ];
        DB::insert('insert into maps (photo, date, area) values(:photo, :date, :area)', $param);
        return redirect('/map');
    }

    public function edit(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from maps where id = :id', $param);
        return view('map.edit', ['form' => $item[0]]);
    }

    public function update(Request $request) {
        $param = [
            'id' => $request->id,
            'photo' => $request->photo,
            'date' => $request->date,
            'area' => $request->area,
        ];
        DB::update('update maps set photo = :photo, date = :date, area = :area where id = :id', $param);
        return redirect('/map');
    }

    public function del(Request $request) {
        $param = ['id' => $request->id];
        $item = DB::select('select * from maps where id = :id', $param);
        return view('map.del', ['form' => $item[0]]);
    }

    public function remove(Request $request) {
        $param = ['id' => $request->id];
        DB::delete('delete from maps where id = :id', $param);
        return redirect('/map');
    }

    public function getImageInput(){
        $items = DB::select('select * from maps');
        return view('map.add', ['items' => $items]);
    }

    public function postImageConfirm(Request $request){
        $post_data = $request->except('photo');
        $photo = $request->file('photo');
    
        $temp_path = $photo->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path); 

        $date = $post_data['date'];
        $area = $post_data['area'];
    
        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'date' => $date,
            'area' => $area,
        );
        $request->session()->put('data', $data);
    
        return view('map.add', compact('data'));
    }

    public function postImageComplete(Request $request) {
        $data = $request->session()->get('data');
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
    
        $filename = str_replace('public/temp/', '', $temp_path);
        $storage_path = 'public/productimage/'.$filename;
    
        $request->session()->forget('data');
    
        Storage::move($temp_path, $storage_path);
    
        $read_path = str_replace('public/', 'storage/', $storage_path);
        $date = $data['date'];
        $area = $data['area'];
    
        //$this->productcontroller->path = $read_path;
        //$this->productcontroller->product_name = $product_name;
        //$this->productcontroller->save();

        $param = [
            'photo' => $read_path,
            'date' => $date,
            'area' => $area,
        ];
        DB::table('maps')->insert($param);
        return view('map.confirm');
        
    }
}