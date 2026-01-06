<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Show registration form
     */
    public function create()
    {
        return view('registration.form');
    }

    /**
     * Store registration data
     */
    public function store(\App\Http\Requests\StoreSantriRequest $request)
    {
        DB::beginTransaction();
        try {
            // Upload files
            $fotoPath = $request->file('foto')->store('santri/foto', 'public');
            $ijazahPath = $request->hasFile('ijazah') 
                ? $request->file('ijazah')->store('santri/ijazah', 'public') 
                : null;
            $aktaPath = $request->hasFile('akta') 
                ? $request->file('akta')->store('santri/akta', 'public') 
                : null;

            // Create Santri
            $santri = Santri::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'asal_sekolah' => $request->asal_sekolah,
                'nilai_rata' => $request->nilai_rata,
                'foto' => $fotoPath,
                'ijazah' => $ijazahPath,
                'akta' => $aktaPath,
                'gelombang' => $this->getCurrentGelombang(),
                'tahun_ajaran' => date('Y'),
            ]);

            // Create Orang Tua
            OrangTua::create([
                'santri_id' => $santri->id,
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'no_hp_orangtua' => $request->no_hp_orangtua,
            ]);

            DB::commit();

            // Send email notification
            try {
                \Illuminate\Support\Facades\Mail::to($santri->email)->send(new \App\Mail\RegistrationSuccess($santri));
            } catch (\Exception $e) {
                // Log error but don't fail the registration
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email pendaftaran: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil!',
                'redirect' => route('registration.success', ['nomor' => $santri->nomor_pendaftaran]),
                'data' => [
                    'nomor_pendaftaran' => $santri->nomor_pendaftaran,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Delete uploaded files if error
            if (isset($fotoPath)) Storage::disk('public')->delete($fotoPath);
            if (isset($ijazahPath)) Storage::disk('public')->delete($ijazahPath);
            if (isset($aktaPath)) Storage::disk('public')->delete($aktaPath);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show success page
     */
    public function success($nomor)
    {
        $santri = Santri::where('nomor_pendaftaran', $nomor)->firstOrFail();
        
        return view('registration.success', compact('santri'));
    }

    /**
     * Get current gelombang based on date
     */
    private function getCurrentGelombang()
    {
        $month = date('n');
        
        // Gelombang 1: Jan-Mar
        if ($month >= 1 && $month <= 3) return 1;
        
        // Gelombang 2: Apr-Jun
        if ($month >= 4 && $month <= 6) return 2;
        
        // Gelombang 3: Jul-Sep
        if ($month >= 7 && $month <= 9) return 3;
        
        // Gelombang 4: Oct-Dec
        return 4;
    }
}
