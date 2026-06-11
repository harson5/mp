<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::query();
        if (request()->has('payment_status')) {
            $users->where('payment_status', request('payment_status')); 
        }
        $users = $users
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users.index', [
            'users' => $users,
            'totalScore' => auth()->user()->score,
        ]);
    }

    public function create(): View
    {
        return view('admin.users.form', [
            'user' => new User,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatedUser($request);

        if (! isset($validated['password']) || $validated['password'] === null) {
            $validated['password'] = bcrypt(str()->random(16));
        }

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('admin.users.form', [
            'user' => $user,
            'totalScore' => auth()->user()->score,
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $this->validatedUser($request, $user);

        if (isset($validated['password']) && $validated['password'] === null) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted.');
    }

    private function validatedUser(Request $request, ?User $user = null): array
    {
        $rules = [
            'name' => [
                $user ? 'sometimes' : 'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($user),
            ],
            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user),
            ],
            'password' => [
                $user ? 'nullable' : 'required',
                'string',
                'min:8',
            ],
            'payment_status' => ['sometimes', 'in:unpaid,paid,verified'],
        ];

        return $request->validate($rules);
    }
    public function updateVerify(User $user): RedirectResponse
    {
        $user->update(['payment_status' => 'verified']);

        $dataForMail = [
            'file'    => 'mail.user-verified',
            'mailTo'    => $user->email,
            'subject'   => 'User Verified',
            'first_name'      => $user->name,
        ];
        $this->sendMail($dataForMail);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User payment verified successfully.');
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
}
