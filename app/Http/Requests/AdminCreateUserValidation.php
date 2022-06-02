<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateUserValidation extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'contact' => 'required|min:10|max:10',
            'designation' => 'required',
            'date_of_birth' => 'required',
            'date_of_join' => 'required',
            'office_id' => 'required',
            'district_id' => 'required',
            'circle_id' => 'required',
            'division_id' => 'required',
            'range_id' => 'required',
            'office_address' => 'required',
            'gender' => 'required',
            'qualification' => 'required',
            'username' => 'required|unique:users,username|min:5',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'isAdmin' => 'required',
            'status' => 'required'
        ];
    }
}
