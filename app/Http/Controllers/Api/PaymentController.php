<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Create Stripe checkout session.
     */
    public function createCheckout(Request $request)
    {
        // For now, return mock response
        // In production, integrate with Stripe SDK
        return response()->json([
            'message' => 'Checkout session created',
            'checkout_url' => 'https://checkout.stripe.com/...',
        ]);
    }

    /**
     * Handle payment success.
     */
    public function paymentSuccess(Request $request)
    {
        // Mark user as premium
        $user = $request->user();
        $user->update([
            'subscription_status' => 'premium',
            'subscription_expires_at' => now()->addYear(),
        ]);

        // Record payment
        Payment::create([
            'user_id' => $user->id,
            'stripe_transaction_id' => $request->input('transaction_id'),
            'amount' => 5.00,
            'currency' => 'USD',
            'status' => 'completed',
            'payment_method' => 'stripe',
            'description' => 'Premium subscription',
        ]);

        return response()->json([
            'message' => 'Payment successful. Premium access granted.',
        ]);
    }

    /**
     * Handle payment cancellation.
     */
    public function paymentCancel(Request $request)
    {
        return response()->json([
            'message' => 'Payment cancelled',
        ]);
    }

    /**
     * Get payment history.
     */
    public function paymentHistory(Request $request)
    {
        $payments = Payment::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return response()->json([
            'message' => 'Payment history retrieved',
            'data' => $payments,
        ]);
    }
}
