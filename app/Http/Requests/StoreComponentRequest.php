<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComponentRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'reference' => ['required', 'string', 'max:255', 'unique:components,reference'],
            'type' => ['required', Rule::in(['resistor', 'capacitor', 'microcontroller'])],
            'description' => ['nullable', 'string'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'specifications' => ['nullable', 'array'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Le nom du composant est obligatoire.',
            'reference.required' => 'La référence est obligatoire.',
            'reference.unique' => 'Cette référence existe déjà.',
            'type.required' => 'Le type de composant est obligatoire.',
            'type.in' => 'Le type doit être : resistor, capacitor ou microcontroller.',
            'stock_quantity.required' => 'La quantité en stock est obligatoire.',
            'stock_quantity.min' => 'La quantité ne peut pas être négative.',
            'price.required' => 'Le prix est obligatoire.',
            'price.min' => 'Le prix ne peut pas être négatif.',
        ];
    }
}

