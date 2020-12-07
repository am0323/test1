<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function authorize()
    {
        if ($this->path() == 'player/create'){
            return true;
        } else {
            return false;
        }
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required|date',
        ];
    }

    public function messages() {
        return [
            'name.required' => '名前は必ず入力してください。',
            'date.required' => '日付は必ず入力してください。',
            'date.date' => '日時で入力してください。',
        ];
    }
}
