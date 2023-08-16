@extends('admin.layouts.master')
@section('title',$title)
@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>TRX ID</th>
                    <th>Status</th>
                    <th>User</th>
                    <th>Fee</th>
                    <th>Amount</th>
                    <th>Final</th>
                    <th>Details</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($withdraws as $key => $item)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$item->code}}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="ms-2 badge bg-success">{{__('PAID')}}</span>
                        @elseif ($item->status == 2)
                            <span class="ms-2 badge bg-danger">{{__('CANCELED')}}</span>
                        @else
                            <span class="ms-2 badge bg-warning">{{__('PENDING')}}</span>
                        @endif
                    </td>
                    <td>{{$item->user->username}}</td>
                    <td>{{format_price($item->charge)}}</td>
                    <td>{{get_setting('currency')}}{{$item->amount}}</td>
                    <td>{{format_price($item->final)}}</td>
                    <td>
                        <p class="mb-0">Bank Name: {{$item->user->bank_name}}</p>
                        <p class="mb-0">Account Name: {{$item->user->acc_name}}</p>
                        <p class="mb-0">Account Number: {{$item->user->acc_number}}</p>
                    </td>
                    <td>{{ date('F d, Y H:m:s', strtotime($item->created_at))}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#view_profile" title="view"><i class="fa fa-eye"></i></a>
                        @if($item->status == 0)
                        <a class="btn btn-success btn-sm" href="{{route('admin.withdraw.pay',$item->id)}}" title="pay"><i class="fa fa-check"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{route('admin.withdraw.delete',$item->id)}}"><i class="fa fa-trash" title="delete"></i></a>
                        @endif
                    </td>
                </tr>
                {{-- Modal --}}
                <div class="modal fade" id="view_profile" tabindex="0" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" id="modal-size" role="document">
                        <div class="modal-content position-relative">
                            <div class="modal-header">
                                <h5 class="modal-title">User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <p>Phone Number: {{$item->user->phone}}</p>
                            <p>Bank Name: {{$item->user->bank_name}}</p>
                            <p>Account Name: {{$item->user->acc_name}}</p>
                            <p>Account Number: {{$item->user->acc_number}}</p>
                            <p>Balance: {{get_setting('currency')}}{{$item->user->balance}}</p>
                            <p>Withdraw Amount: {{get_setting('currency')}}{{$item->amount}}</p>
                            <p>Admin Message: {{$item->message}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
