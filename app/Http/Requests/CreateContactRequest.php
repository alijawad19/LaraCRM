<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'contact_email' => 'required|string|email|max:255|unique:Contacts',
            'contact_phone_number' => 'required|numeric',
            'contact_address' => 'required|string|max:255',
            'contact_description' => 'required',
            'company_name' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'status' => 'required',
            'created_by' => 'required|exists:Users,id',
            'contact_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
