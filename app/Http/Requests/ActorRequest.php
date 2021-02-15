<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActorRequest extends FormRequest
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
            'name'   => 'required|string|min:3|max:255',
            'bio'    => 'required|string|min:3|max:255',
            'born_at' => 'required|integer|min:1900|max:2021'
        ];
    }
}


