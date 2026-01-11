<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeddingRequest extends FormRequest
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
            'slug' => 'required|string|',
            'groom_name' => 'required|string|max:100',
            'groom_father' => 'required|string|max:100',
            'groom_mother' => 'required|string|max:100',
            'bride_name' => 'required|string|max:100',
            'bride_father' => 'required|string|max:100',
            'bride_mother' => 'required|string|max:100',
            'akad_date' => 'required|date',
            'akad_location' => 'required|string|max:255',
            'reception_date' => 'required|date|after_or_equal:akad_date',
            'reception_location' => 'required|string|max:255',
            'theme' => 'required|in:classic,modern,elegant',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'slug.required' => 'Slug pernikahan harus diisi.',
            'slug.unique' => 'Slug pernikahan sudah digunakan.',
            'slug.regex' => 'Slug hanya boleh mengandung huruf kecil, angka, dan tanda hubung.',
            'groom_name.required' => 'Nama pengantin pria harus diisi.',
            'bride_name.required' => 'Nama pengantin wanita harus diisi.',
            'reception_date.after_or_equal' => 'Tanggal resepsi harus sama atau setelah tanggal akad.',
        ];
    }
}
