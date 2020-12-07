<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function getImageInput(){
        $items = DB::select('select * from products');
        return view('image_input', ['items' => $items]);
    }

    public function postImageConfirm(Request $request){
        $post_data = $request->except('imagefile');
        $imagefile = $request->file('imagefile');
    
        $temp_path = $imagefile->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path); 

        $product_name = $post_data['product_name'];
    
        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'product_name' => $product_name,
        );
        $request->session()->put('data', $data);
    
        return view('image_confirm', compact('data'));
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
        $product_name = $data['product_name'];
    
        //$this->productcontroller->path = $read_path;
        //$this->productcontroller->product_name = $product_name;
        //$this->productcontroller->save();

        $param = [
            'path' => $read_path,
            'product_name' => $product_name,
        ];
        DB::table('products')->insert($param);
        return redirect('image_input');
        
    }
}
