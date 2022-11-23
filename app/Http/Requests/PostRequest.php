<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    /**
     * Definisikan atribut nilai pada tabel post
     * yang akan di validasi 
     * ke method rules
     */
    public function rules(Request $request)
    {
        return [
            'title' => ['required'],
            'category_id' => ['required'],
            'image' => ['mimes:png,jpg,jpeg'],
            'content' => ['required']
        ];
    }
}
