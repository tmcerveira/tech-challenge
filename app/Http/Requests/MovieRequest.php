<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'year' => 'required|integer',
            'synopsis' => 'required|string|min:3|max:255',
            'runtime' => 'required|integer|min:30|max:770',
            'released_at' => 'required|integer',
            'cost' => 'required|integer|min:1000|max:10000000',
            'genre' => 'required|string|min:3|max:255',
        ];
    }
}


