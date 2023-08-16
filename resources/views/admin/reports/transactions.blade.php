@extends('admin.layouts.master')
@section('title') Transaction Log @stop
@section('content')
<div class="page-title">
    <div class="d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Transactions</h5>
    </div>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered" id="datatable">
            <thead>
                <tr>         
                    <th>#</th>
                    <th>User</th>           
                    <th>TRX Code</th>
                    <th>Amount</th>
                    <th>Final Balance</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trx as $key => $item)
                <tr>
                    <td>{{$key +1}}</td>
                    <td>{{$item->user->username}}</td>
                    <td>{{$item->code}}</td>
                    <td>{{format_price($item->amount)}}</td>
                    <td>{{format_price($item->new_balance)}}</td>
                    <td>{{$item->message}}</td>
                    <td>{{ show_datetime($item->created_at)}}</td>
                </tr>
                
            @endforeach 
            </tbody>
        </table>  
    </div>
</div>
@endsection

@section('scripts')
@endsection

@section('styles')
<style>
    .timg{
        width:50px;
        height:50px;
    }
    .user-image {
        width: 200px;
        height: 200px;
    }

</style>
@stop