@extends('admin.layouts.master')
@section('title', $title)
@section('content')

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>TRX Code</th>
                    <th>Charge</th>
                    <th>Amount</th>
                    <th>Final Balance</th>
                    <th>Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdraws as $key => $item)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$item->user->username}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->charge}}</td>
                    <td>{{$item->amount}}</td>
                    <td>{{$item->final}}</td>
                    <td>{{ show_datetime($item->created_at)}}</td>
                    <td>
                        <a class="btn btn-success btn-sm" href="{{route('admin.withdraw.pay',$item->id)}}" title="pay"><i class="fa fa-check"></i></a>
                        <a class="btn btn-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#view_profile" title="view"><i class="fa fa-eye"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{route('admin.withdraw.delete',$item->id)}}"><i class="fa fa-trash" title="delete"></i></a>
                    </td>
                </tr>
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
