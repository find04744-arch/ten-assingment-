@extends('layouts.app')

@section('title', 'Upgrade to Premium')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center">Upgrade to Premium</h1>

        <div class="bg-white rounded-lg shadow p-8">
            @if (auth()->user()->subscription_status === 'premium')
                <div class="text-center">
                    <div class="text-5xl mb-4">✅</div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">You're a Premium Member</h2>
                    <p class="text-gray-600 mb-4">Expires: {{ auth()->user()->subscription_expires_at?->format('M d, Y') }}
                    </p>
                </div>
            @else
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Premium Benefits</h2>
                    <ul class="space-y-3">
                        <li class="flex items-center">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Unlimited prompt uploads</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Advanced analytics</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Priority support</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-500 mr-3">✓</span>
                            <span>Featured placement</span>
                        </li>
                    </ul>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Payment Details</h3>
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">One-time payment:</span>
                            <span class="font-bold text-2xl text-blue-600">$5</span>
                        </div>
                        <p class="text-sm text-gray-500">Valid for 1 year from purchase</p>
                    </div>
                </div>

                <form action="{{ route('payment.checkout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-bold text-lg">
                        💳 Complete Payment
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-4">Secure payment powered by Stripe</p>
            @endif
        </div>
    </div>
@endsection
