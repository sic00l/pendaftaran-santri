<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSantriRequest extends FormRequest
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
            // Data Diri
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:santri,nik',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'email' => 'required|email|unique:santri,email',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string',
            
            // Pendidikan
            'asal_sekolah' => 'required|string|max:255',
            'nilai_rata' => 'required|numeric|min:0|max:100',
            
            // Orang Tua
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'no_hp_orangtua' => 'required|string|max:15',
            
            // Files
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5120',
            'akta' => 'nullable|file|mimes:pdf,jpeg,jpg,png|max:5120',
            
            // Agreement
            'agree_terms' => 'accepted',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nik.unique' => 'NIK sudah terdaftar',
            'email.unique' => 'Email sudah terdaftar',
            'foto.required' => 'Foto 3x4 wajib diupload',
            'foto.max' => 'Ukuran foto maksimal 2MB',
            'agree_terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ];
    }
}
