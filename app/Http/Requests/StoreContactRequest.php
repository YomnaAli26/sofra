<?php

namespace App\Http\Requests;

use App\Enums\ContactStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[
            'name'=>['required','string','max:255'],
            'email'=>['required','string','email','max:255'],
            'phone'=>['required','string','max:255'],
            'message'=>['required','string','max:255'],
            'status'=>['required','string','in:'.implode(',',array_map(fn($case)=> $case->value, ContactStatus::cases()))],
        ];
    }
}
