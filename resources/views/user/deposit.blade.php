@extends('user.layouts.master')

@section('title', 'Deposit Money')

@section('content')
<div class="col-12">
<div class="card">
    <div class="card-body">
        <h4 class="fw-bold my-0">Fund Account</h4> <hr class="mt-0">
        <form action="{{route('user.deposit.fund')}}" method="post">
            @csrf
            <div class="form-group">
                <label class="form-label fw-bold">Amount</label>
                <input type="number" class="form-control form-control-lg" name="amount" step="1" min="{{sys_setting('min_deposit')}}" required placeholder="Amount">
            </div>
            {{-- payment gateway --}}
            <div class="form-group">
                <label class="form-label fw-bold mt-1">Payment Method</label>
                <div class="list-group">
                @if(sys_setting('bank_transfer') == 1)
                <label class="list-group-item">
                    <input class="form-check-input me-2" type="radio" name="gateway" value="manual">Manual Transfer
                </label>
                @endif
                @if(sys_setting('flutter_payment') == 1)
                <label class="list-group-item">
                    <input class="form-check-input me-2" type="radio" name="gateway" value="flutter">Bank Transfer
                </label>
                @endif
                </div>
            </div>
            <div class="form-group mb-0">
                <button class="btn btn-primary w-100" type="submit">Fund Wallet</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
