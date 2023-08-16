@extends('user.layouts.master')

@section('title', 'Deposit History')

@section('content')
<div class="col-12">
    <div class="card">
        <h4 class="card-header">Deposit History</h4>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                      <th>#</th>
                      <th>Amount</th>
                      <th>Method</th>
                      <th>Trx Code</th>
                      <th>Date</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($deposits as $key=> $item)
                      <tr>
                        <td>{{$key +1 }}</td>
                        <td>{{format_price($item->amount) }}</td>
                        <td>{{$item->gateway }}</td>
                        <td>{{$item->trx}}</td>
                        <td>{{show_datetime($item->created_at)}}</td>
                        <td>{{$item->message}}</td>
                      </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
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
