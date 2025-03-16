<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Student;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'email' => 'Format harus berupa email',
            'string' => ':attribute harus berupa string',
        ], [
            'email' => 'Email',
            'password' => 'Password',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('overview')->with('success', 'Login Berhasil');
        }

        return back()->with(['error' => 'Invalid credentials']);
    }

    public function registerPage()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|max:255|min:6',
            'nim' => 'required|string|max:255|unique:students,nim',
            'study_program' => 'required|max:255|string',
        ],[
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'min' => ':attribute minimal :min karakter',
            'email' => ':attribute harus berupa email',
            'confirmed' => ':attribute konfirmasi harus sama',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa string',
        ],[
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi Password',
            'nim' => 'NIM',
            'study_program' => 'Program Studi',
        ]);

        // try catch
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'student',
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'student_name' => $request->name,
                'nim' => $request->nim,
                'study_program' => $request->study_program,
            ]);

            return redirect()->route('login')->with('success', 'Registrasi Berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Registrasi Gagal');
        }
    }

    public function setting()
    {
        $data = Auth::user();
        return view('pages.setting.index', compact('data'));
    }

    public function profilePost(Request $request)
    {
        $data = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255'
        ],[
            'required' => ':attribute harus diisi',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa string',
        ],[
            'name' => 'Nama Lengkap',
        ]);

        try {
            $data->update([
                'name' => $request->name,
            ]);

            if (Auth::user()->role == 'student') {
                $student = Student::where('user_id', $data->id)->first();
                $student->update([
                    'student_name' => $request->name,
                ]);
            }

            return redirect()->route('setting')->with('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Gagal memperbarui profil');
        }
    }

    public function passwordPost(Request $request)
    {
        $data = Auth::user();
        $request->validate([
            'current_password' => 'required|max:255|min:6',
            'password' => 'required|min:6|max:255|confirmed',
            'password_confirmation' => 'required|max:255|min:6',
        ],[
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'confirmed' => ':attribute konfirmasi harus sama',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa string',
        ],[
            'current_password' => 'Password Lama',
            'password' => 'Password Baru',
            'password_confirmation' => 'Konfirmasi Password Baru',
        ]);

        try {
            if (!Hash::check($request->current_password, $data->password)) {
                return back()->withErrors(['current_password' => 'Password tidak sesuai.']);
            }

            $data->update(['password' => Hash::make($request->password)]);

            return redirect()->route('setting')->with('success', 'Password berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Gagal memperbarui password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

