@extends('user.layouts.master')

@section('title', 'Manual Deposits')

@section('content')
<div class="col-12">
    <div class="card">
        <h4 class="card-header">Deposit History</h4>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>TRX ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Receipts</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($mdeposit as $key => $item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{format_price($item->amount)}}</td>
                        <td>{{show_datetime($item->created_at)}}</td>
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
                        <td><a href="#manualReceipt{{$item->id}}" data-bs-toggle="modal" class="btn-primary btn btn-sm">View</a></td>
                    </tr>
                    {{-- Modal --}}
                    <div class="modal fade" id="manualReceipt{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"> Payment Receipt</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{my_asset($item->image)}}" alt="" class="man-img">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> @lang('Close')</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
