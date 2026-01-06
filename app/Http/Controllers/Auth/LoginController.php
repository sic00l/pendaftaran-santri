<?php

namespace App\Http\Controllers\Auth;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use App\Models\Santri;

	class LoginController extends Controller
	{
	    /**
	     * Handle Admin Login
	     */
	    public function adminLogin(Request $request)
	    {
	        $credentials = $request->validate([
	            'email' => 'required|email',
	            'password' => 'required',
	        ]);

	        if (Auth::attempt($credentials, $request->remember)) {
	            $request->session()->regenerate();
	            return redirect()->intended(route('admin.dashboard'));
	        }

	        return back()->withErrors([
	            'email' => 'Email atau password salah.',
	        ])->withInput($request->only('email', 'remember'));
	    }

	    /**
	     * Handle Santri Login
	     */
	    public function santriLogin(Request $request)
	    {
	        $request->validate([
	            'login' => 'required',
	            'password' => 'required',
	        ]);

	        // Check if login is email or nomor_pendaftaran
	        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nomor_pendaftaran';

	        $credentials = [
	            $loginType => $request->login,
	            'password' => $request->password,
	        ];

	        if (Auth::guard('santri')->attempt($credentials)) {
	            $request->session()->regenerate();
	            return redirect()->intended(route('santri.dashboard'));
	        }

	        return back()->withErrors([
	            'login' => 'Email/Nomor Pendaftaran atau password salah.',
	        ])->withInput($request->only('login'));
	    }

	    /**
	     * Handle Logout
	     */
	    public function logout(Request $request)
	    {
	        if (Auth::guard('santri')->check()) {
	            Auth::guard('santri')->logout();
	        } else {
	            Auth::logout();
	        }

	        $request->session()->invalidate();
	        $request->session()->regenerateToken();

	        return redirect()->route('home');
	    }
	}
	
