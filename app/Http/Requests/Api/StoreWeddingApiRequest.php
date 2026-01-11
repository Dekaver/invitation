<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeddingApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Step 1: Groom & Bride Details
            'groom_name' => 'required|string|max:100',
            'groom_father' => 'nullable|string|max:100',
            'groom_mother' => 'nullable|string|max:100',
            'bride_name' => 'required|string|max:100',
            'bride_father' => 'nullable|string|max:100',
            'bride_mother' => 'nullable|string|max:100',

            // Step 2: Akad Details
            'akad_date' => 'required|date|after:today',
            'akad_location' => 'required|string|max:255',

            // Step 3: Reception Details
            'reception_date' => 'required|date|after_or_equal:akad_date',
            'reception_location' => 'required|string|max:255',

            // Step 4: Theme & Settings
            'theme' => 'required|in:classic,modern,elegant',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'groom_name.required' => 'Nama pengantin pria harus diisi.',
            'bride_name.required' => 'Nama pengantin wanita harus diisi.',
            'akad_date.required' => 'Tanggal akad harus diisi.',
            'akad_date.after' => 'Tanggal akad harus di masa depan.',
            'akad_location.required' => 'Lokasi akad harus diisi.',
            'reception_date.required' => 'Tanggal resepsi harus diisi.',
            'reception_date.after_or_equal' => 'Tanggal resepsi harus sama atau setelah tanggal akad.',
            'reception_location.required' => 'Lokasi resepsi harus diisi.',
            'theme.required' => 'Tema harus dipilih.',
            'theme.in' => 'Tema yang dipilih tidak valid.',
        ];
    }

    /**
     * Prepare the data for validation.
     * Convert empty strings to null for optional fields.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'groom_father' => $this->groom_father ?: null,
            'groom_mother' => $this->groom_mother ?: null,
            'bride_father' => $this->bride_father ?: null,
            'bride_mother' => $this->bride_mother ?: null,
        ]);
    }
}