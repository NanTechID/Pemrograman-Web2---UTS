<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\Pegawai;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function sendOTP(Request $request)
    {
        if (Pegawai::where('phone', $request->phone)->exists()) {
            return response()->json([
                'status' => 'exists',
                'message' => 'Nomor Anda sudah terdaftar.'
            ]);
        }

        $phone = $request->phone;
        $otp = rand(100000, 999999);

        Session::put('otp_code', $otp);
        Session::put('phone', $phone);

        $appkey = 'd17dbcf2-a137-45af-a033-24a942246016';
        $authkey = 'tqecqRgWa7UJ0uM5pjTqFkUuAOzlMGE2U1EKLvL9cbcQiu2UNY';
        $receiver = $phone;
        $message = "Kode OTP Anda: $otp. Jangan berikan kode ini kepada siapapun.";

        $url = "http://wa.mpdev.my.id/api/create-message";

        try {
            $response = Http::get($url, [
                'appkey' => $appkey,
                'authkey' => $authkey,
                'to' => $receiver,
                'message' => $message,
            ]);

            if ($response->successful()) {
                return response()->json([
                    'message' => 'OTP berhasil dikirim ke WhatsApp Anda',
                    'status' => true
                ]);
            }

            return response()->json([
                'message' => 'Gagal mengirim OTP. Server WhatsApp tidak merespons sukses.',
                'status' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengirim OTP. Silakan coba lagi.',
                'error' => $e->getMessage(),
                'status' => false
            ]);
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'otp_code' => 'required|numeric',
        ]);

        $storedOTP = Session::get('otp_code');
        $storedPhone = Session::get('phone');

        if (!$storedOTP || $storedPhone !== $request->phone || $storedOTP != $request->otp_code) {
            return response()->json([
                'message' => 'OTP salah atau kadaluarsa',
                'status' => false
            ]);
        }

        Session::put('verified_phone', $storedPhone);
        Session::forget('otp_code');
        Session::forget('phone');

        return response()->json([
            'message' => 'Verifikasi berhasil! Lanjut ke input data pegawai.',
            'redirect' => url('/register/data-pegawai'),
            'status' => true,
        ]);
    }

    public function showPegawaiForm()
    {
        return view('auth.register_data_pegawai');
    }
}
