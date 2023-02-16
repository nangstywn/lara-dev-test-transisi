<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompaniesRequest extends FormRequest
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
    public function rules()
    {
        //on create
        $rule =  [
            'nama' => 'required',
            'email' => ['required', Rule::unique('companies', 'email')->ignore($this->company)],
            'website' => 'required',
            'logo' => 'required|image|mimes:png|max:2048|dimensions:min_width=100,min_height=100'
        ];
        //on edit
        if ($this->company != null) {
            $rule['logo'] = 'image|mimes:png|max:2048|dimensions:min_width=100,min_height=100';
        }
        return $rule;
    }
}
