<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'cf-turnstile-response' => 'required|string',
        ]);

        // Validasi CAPTCHA Cloudflare Turnstile
        $turnstileResponse = $request->input('cf-turnstile-response');
        $isValidCaptcha = $this->verifyTurnstile($turnstileResponse);

        if (!$isValidCaptcha) {
            return back()->withErrors([
                'cf-turnstile-response' => 'Verifikasi keamanan gagal. Silakan coba lagi.',
            ])->withInput($request->only('username'));
        }

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'username' => 'Username atau password yang dimasukkan salah.',
        ])->withInput($request->only('username'));
    }

    /**
     * Verify Cloudflare Turnstile CAPTCHA
     */
    private function verifyTurnstile($token)
    {
        $secretKey = config('turnstile.secret_key');
        $verifyUrl = config('turnstile.verify_url');
        $timeout = config('turnstile.timeout', 10);
        $remoteIp = request()->ip();

        try {
            $response = Http::timeout($timeout)->asForm()->post($verifyUrl, [
                'secret' => $secretKey,
                'response' => $token,
                'remoteip' => $remoteIp,
            ]);

            $result = $response->json();
            
            return isset($result['success']) && $result['success'] === true;
        } catch (\Exception $e) {
            Log::error('Turnstile verification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
