<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentProofRequest;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function requestPayment(PaymentProofRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');

        $user = auth()->user();
        $user->update([
            'payment_status' => 'paid',
            'transaction_code' => $validated['transaction_code'],
            'payment_proof' => $proofPath,
        ]);
       


        return redirect()
            ->route('matches.index')
            ->with('success', 'Payment request submitted. Admin will verify shortly.');
    }
}
