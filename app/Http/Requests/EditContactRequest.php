<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255|'.\Illuminate\Validation\Rule::unique('Contacts')->ignore($this->contact->id),
            'contact_phone_number' => 'required|numeric',
            'contact_address' => 'required|string|max:255',
            'contact_description' => 'required',
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'status' => 'required',
            'contact_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];
    }
}
