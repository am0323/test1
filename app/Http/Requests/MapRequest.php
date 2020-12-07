<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapRequest extends FormRequest
{
    public function authorize()
    {
        if($this->path() == 'map') {
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        return [
            'photo' => 'required',
            'date' => 'date',
        ];
    }

    public function messages(){
        return [
            'photo.required' => '写真は必ず選択してください。',
            'date.date' => '日付を入力してください。',
        ];
    }
}
