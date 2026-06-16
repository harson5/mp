<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => User::ROLE_USER,
            'score' => 0,
        ]);

        Auth::login($user);

        return redirect()->route('matches.index')->with('success', 'Welcome! Your account was created.');
    }

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('matches.index'));
        }

        return back()->withErrors([
            'name' => 'Invalid name or password.',
        ])->onlyInput('name');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showForgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(ForgotPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $validated['email']],
            [
                'token' => $token,
                'created_at' => now(),
            ]
        );

        $resetUrl = route('password.reset', ['token' => $token]);
        // $resetUrl = route('password.reset');

        $dataForMail = [
            'file'    => 'mail.password-reset',
            'mailTo'    => $validated['email'],
            'subject'   => 'Password Reset Request',
            'url'       => $resetUrl,
        ];
        $this->sendMail($dataForMail);

        return back()->with('status', 'A password reset link was sent to your email address.Please check your inbox or spam folder and follow the instructions to reset your password.');
    }
    function sendMail($data)
    {
        try {
            Mail::send($data['file'], $data, function ($message) use ($data) {
                $message->to($data['mailTo'])
                    ->subject($data['subject'])
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
            return true;
        } catch (\Exception $e) {
            dd(900, $e->getMessage());
            return false;
        }
    }

    public function showResetPassword(string $token): View
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        if (!$passwordReset || now()->diffInMinutes($passwordReset->created_at) > 60) {
            abort(403, 'This password reset link has expired.');
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $passwordReset->email,
        ]);
    }

    public function updateResetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $validated['token'])
            ->where('email', $validated['email'])
            ->first();

        if (!$passwordReset || now()->diffInMinutes($passwordReset->created_at) > 60) {
            return back()->withErrors(['token' => 'This password reset link has expired.']);
        }

        $user = User::where('email', $validated['email'])->first();
        $user->update(['password' => $validated['password']]);

        DB::table('password_reset_tokens')->where('email', $validated['email'])->delete();

        return redirect()->route('login')->with('success', 'Password reset successfully! Please login with your new password.');
    }
}
