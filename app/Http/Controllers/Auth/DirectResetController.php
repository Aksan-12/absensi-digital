<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DirectResetController extends Controller
{
    /**
     * Tampilkan halaman reset password langsung untuk admin.
     */
    public function showResetForm(Request $request)
    {
        $token = env('ADMIN_RESET_TOKEN');

        return view('auth.direct-reset', ['token' => $token, 'email' => $request->query('email')]);
    }

    /**
     * Tangani permintaan reset password langsung untuk admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        $adminToken = env('ADMIN_RESET_TOKEN');

        if (empty($adminToken) || !hash_equals($adminToken, (string) $request->input('token'))) {
            return redirect()->back()->withErrors(['token' => 'Invalid reset token.']);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (! $user) {
            return redirect()->back()->withErrors(['email' => 'No user found with that email.']);
        }

        $user->password = $request->input('password');
        $user->save();

        return redirect()->route('login')->with('status', 'Password has been reset.');
    }
}
