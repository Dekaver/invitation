<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'rsvp_status' => 'required|in:yes,no,maybe',
            'total_guest' => 'required_if:rsvp_status,yes|nullable|integer|min:1|max:10',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama tamu harus diisi.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'rsvp_status.required' => 'Status RSVP harus dipilih.',
            'total_guest.required_if' => 'Jumlah tamu harus diisi jika akan datang.',
            'total_guest.max' => 'Jumlah tamu maksimal 10 orang.',
        ];
    }
}
