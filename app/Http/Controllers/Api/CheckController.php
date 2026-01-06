<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    /**
     * Check NIK availability
     */
    public function checkNik(Request $request)
    {
        $nik = $request->input('nik');

        if (!$nik || strlen($nik) !== 16) {
            return response()->json([
                'exists' => false,
                'message' => 'NIK tidak valid'
            ]);
        }

        $exists = Santri::where('nik', $nik)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'NIK sudah terdaftar' : 'NIK tersedia'
        ]);
    }

    /**
     * Check Email availability
     */
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                'exists' => false,
                'message' => 'Email tidak valid'
            ]);
        }

        $exists = Santri::where('email', $email)->exists();

        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Email sudah terdaftar' : 'Email tersedia'
        ]);
    }
}
