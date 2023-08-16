@extends('admin.layouts.master')
@section('title',"Payment History")
@section('content')
<div class="page-title">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Payment History 
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>         
                    <th>#</th>
                    <th>TRX ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Details</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($payments as $key => $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{$item->user->name}}</td>
                    <td>{{format_price($item->amount)}}</td>
                    <td><span class="badge bg-info">{{$item->method}}</span></td>
                    <td>{{$item->message}}</td>
                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">@lang('Complete')</span>
                        @elseif ($item->status == 2)
                            <span class="badge bg-warning">@lang('Pending')</span>
                        @elseif ($item->status == 3)
                            <span class="badge bg-danger">@lang('Reject')</span>
                        @endif    
                    </td>                    
                    <td>{{show_datetime($item->created_at)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('styles')
<style>
    .man-img{
        width:100%;
        height: auto;
    }
</style>
@stop