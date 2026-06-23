<?php

namespace App\Http\Controllers;

use App\Models\AkunUser;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the application's login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::guard('web')->attempt([$loginField => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        throw ValidationException::withMessages([
            'username' => 'Username/Email atau password salah.',
        ]);
    }

    /**
     * Show the application registration form.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:akun_user',
            'password' => 'required|string|min:8|confirmed',
            'nama_user' => 'required|string|max:100',
            'nim' => 'required|string|max:15|unique:akun_user',
            'email' => 'required|string|email|max:50|unique:akun_user',
            'no_hp' => 'required|string|max:15|unique:akun_user',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $jabatanAnggota = Jabatan::where('nama_jabatan', 'Anggota')->first();
        $idJabatan = $jabatanAnggota ? $jabatanAnggota->id_jabatan : 3;

        $user = AkunUser::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama_user' => $request->nama_user,
            'nim' => $request->nim,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'role' => 'Anggota',
            'id_jabatan' => $idJabatan,
            'is_admin' => 0,
        ]);

        try {
            $user->assignRole('Anggota');
        } catch (\Exception $e) {
            // Abaikan jika role Spatie belum siap
        }

        Auth::guard('web')->login($user);

        return redirect('/');
    }

    /**
     * Show the user's profile page.
     */
    public function showProfile()
    {
        $user = Auth::guard('web')->user();
        return view('auth.profile', ['user' => $user]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Update user profile photo.
     */
    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::guard('web')->user();

        if ($request->hasFile('foto_profil')) {
            // Delete old photo if exists
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Store new photo
            $path = $request->file('foto_profil')->store('profile-photos', 'public');
            
            // Update database
            $user->update([
                'foto_profil' => $path
            ]);
        }

        return redirect()->route('profile')->with('status', 'Foto profil berhasil diperbarui.');
    }
}
