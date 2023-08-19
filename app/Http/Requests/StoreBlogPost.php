<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
{
   
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|unique:users|confirmed|exists:users',
            'password' => 'required|string|min:6|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|min:6',
            'phone' => 'required|regex:/[6-9]{10}/',
            'stathero' => 'numeric|regex:/[2-9]{10}/',
            'name' => 'required|max:12',
            'surname' => 'required|max:13',
            'city' => 'required|max:12',
            'address' => 'required|max:25',
            'zip' => 'required|numeric|min:5',
            'vatnumber' => 'nullable|regex:/(01)[0-8]{8}/'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'An email is required',
            'password.required' => 'A password is required',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'email address',
        ];
    }
    public function store(StoreBlogPost $request)
        {
            // The incoming request is valid...

            // Retrieve the validated input data...
            $validated = $request->validated();
        }
        
        public function withValidator($validator)
        {
            $validator->after(function ($validator) {
                if ($this->somethingElseIsInvalid()) {
                    $validator->errors()->add('field', 'Something is wrong with this field!');
                }
            });
        }
}
