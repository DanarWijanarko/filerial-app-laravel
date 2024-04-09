<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'address' => ['required'],
            'social' => ['required'],
            'social.*.type' => ['required', 'string', 'in:instagram,tiktok,facebook'],
            'social.*.username' => ['required', 'string', 'distinct'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages() : array
    {
        return [
            'social.*.type.in' => 'The selected social media type is invalid.',
            'social.*.username.required' => 'The username social media field is required.',
            'social.*.username.distinct' => 'The username social media field has duplicate value.',
        ];
    }
}
