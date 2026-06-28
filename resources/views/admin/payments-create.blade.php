@extends('layouts.admin')
@section('title', 'Record Payment')
@section('subtitle', 'Manually log a payment transaction')

@section('content')
<div class="fade-up" style="max-width:760px">
    <a href="{{ route('admin.payments') }}" class="act-btn" style="color:#64748b;border-color:#e2e8f0;background:#fff;margin-bottom:20px;display:inline-flex">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        Back to Payments
    </a>
    <div style="border-radius:22px;overflow:hidden;box-shadow:0 4px 28px rgba(0,0,0,.08);border:1px solid #e8ecf4">
        <div style="background:linear-gradient(135deg,#022c22,#064e3b,#059669);padding:20px 26px;display:flex;align-items:center;gap:14px;position:relative;overflow:hidden">
            <div style="position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,.05)"></div>
            <div style="width:42px;height:42px;border-radius:13px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#6ee7b7" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
            </div>
            <div><p style="font-size:16px;font-weight:800;color:#fff">Record a Payment</p><p style="font-size:12px;color:rgba(110,231,183,.5);margin-top:2px">Log a manual or offline transaction</p></div>
        </div>
        <div style="background:#fff;padding:30px 26px">
            <form action="{{ route('admin.payments.store') }}" method="POST">
                @csrf
                <div class="form-section">
                    <p class="form-section-title">Transaction Details</p>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">User <span>*</span></label>
                        <select name="user_id" class="form-input form-select" required>
                            <option value="">Select a user</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id')==$user->id?'selected':'' }}>{{ $user->name }} — {{ $user->email }}</option>
                            @endforeach
                        </select>
                        @error('user_id')<p class="form-error-msg">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">Amount <span>*</span></label>
                            <input type="number" name="amount" value="{{ old('amount') }}" class="form-input" step="0.01" min="0" placeholder="0.00" required>
                            @error('amount')<p class="form-error-msg">{{ $message }}</p>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Currency</label>
                            <select name="currency" class="form-input form-select">
                                @foreach(['USD','BDT','EUR','GBP','CAD','AUD'] as $c)
                                    <option value="{{ $c }}" {{ old('currency','USD')==$c?'selected':'' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span>*</span></label>
                            <select name="status" class="form-input form-select" required>
                                @foreach(['completed','paid','pending','failed','refunded'] as $s)
                                    <option value="{{ $s }}" {{ old('status','completed')==$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-section">
                    <p class="form-section-title">Payment Info</p>
                    <div class="form-grid-2" style="margin-bottom:18px">
                        <div class="form-group">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-input form-select">
                                <option value="">Select method</option>
                                @foreach(['card','stripe','paypal','bank_transfer','cash','bkash','nagad'] as $m)
                                    <option value="{{ $m }}" {{ old('payment_method')==$m?'selected':'' }}>{{ ucwords(str_replace('_',' ',$m)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Payment Date</label>
                            <input type="datetime-local" name="payment_date" value="{{ old('payment_date', now()->format('Y-m-d\TH:i')) }}" class="form-input">
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom:18px">
                        <label class="form-label">Transaction / Reference ID</label>
                        <input type="text" name="stripe_transaction_id" value="{{ old('stripe_transaction_id') }}" class="form-input" placeholder="e.g. ch_3OzPxx... or REF-2024-001">
                        <p class="form-hint">Stripe charge ID, bank reference, or any tracking identifier</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description / Notes</label>
                        <textarea name="description" class="form-input form-textarea" placeholder="What this payment is for...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div style="display:flex;gap:12px;padding-top:8px;border-top:1px solid #f1f5f9;margin-top:4px">
                    <button type="submit" class="btn-primary" style="background:linear-gradient(135deg,#059669,#047857)">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                        Record Payment
                    </button>
                    <a href="{{ route('admin.payments') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
