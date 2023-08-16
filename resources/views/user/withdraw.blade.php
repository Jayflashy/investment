@extends('user.layouts.master')

@section('title', 'Withdraw Money')

@section('content')
<div class="col-12">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <h4 class="card-header fw-bold"> Request For Withdrawal </h4>
                <div class="card-body row">
                    <div class="col-md-4">
                        <div class="card outline-success">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-success">{{ format_price(Auth::user()->balance) }}</h4>
                                    <span class="text-success">Balance</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card outline-danger">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-danger">{{ format_price(sys_setting('min_withdraw')) }}</h4>
                                    <span class="text-danger">Minimum WIthdrawal</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card outline-primary">
                            <div class="card-body">
                                <div class="media align-items-center">
                                <div class="media-body text-start">
                                    <h4 class="mb-0 text-primary">{{ format_price(sys_setting('withdraw_charge')) }}</h4>
                                    <span class="text-primary">Withdrawal Fee</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(sys_setting('withdrawal') == 1)
                    <form class="" action="{{ route('user.withdraw.submit') }}" method="post">
                        @csrf
                        <div class="modal-body px-3 pt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Amount <span class="text-danger fw-bold">*</span></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control mb-3" name="amount" min="{{sys_setting('min_withdraw')}}" max="{{ Auth::user()->balance}}" placeholder="Amount" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Message to admin</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="message" rows="3" class="form-control mb-1"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-2 text-end">
                            <button type="submit" class="btn btn-primary">Withdraw Money</button>
                        </div>
                    </form>
                    @else
                        <span class="border border-danger p-3 text-center">
                            <h5 class="fw-bold text-danger">Sorry Withrawal of money has been temporary closed. <br> Please Check Back Later</h5>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <h5 class="card-header">Withdraw Requests</h5>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>TRX Code</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Charge</th>
                        <th>To Receive</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($withdraws as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{format_price($item->amount)}}</td>
                            <td>{{$item->code}}</td>
                            <td> {{ show_datetime($item->created_at) }}</td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="ms-2 badge bg-success">{{__('PAID')}}</span>
                                @elseif ($item->status == 2)
                                    <span class="ms-2 badge bg-danger">{{__('CANCELED')}}</span>
                                @else
                                    <span class="ms-2 badge bg-warning">{{__('PENDING')}}</span>
                                @endif
                            </td>
                            <td>{{format_price($item->charge)}}</td>
                            <td>{{format_price($item->final)}}</td>
                            <td>{{$item->message}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
