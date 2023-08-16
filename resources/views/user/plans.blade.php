@extends('user.layouts.master')

@section('title', 'Investment Plans')

@section('content')
<div class="col-12">
    <div class="row g-4">

        @foreach ($plans as $item)
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card mb-3">
                <img class="card-img-top img-fluid plan-img" src="{{my_asset($item->image)}}"alt="{{$item->name}}">
                <div class="card-body">
                    <h3 class="fw-bold text-uppercase">{{$item->name}}</h3>
                    <div class="d-flex justify-content-between border border-info p-2">
                        <div>
                            <small>You get</small>
                            <h4 class="fw-bold mb-0">{{format_price($item->return)}} </h4>
                            <small>Per {{$item->duration}} Hours</small>
                        </div>
                        <div class="text-end">
                            <small >Gross Income</small>
                            <h4 class="fw-bold mb-0">{{format_price($item->return * $item->days)}} </h4>
                            <small>After {{$item->days}} Days</small>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span><h3 class="fw-bold">{{format_price($item->price)}} </h3></span>
                        <button type="button" class="px-4 btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#planModal-{{$item->id}}">INVEST NOW</button>
                        {{-- MOdal --}}
                        <div class="modal fade bs-example-modal-sm" id="planModal-{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title mt-0" id="mySmallModalLabel"> Invest on @lang($item->name.' Plan')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between border border-info p-2">
                                            <div>
                                                <small>You get</small>
                                                <h4 class="fw-bold mb-0">{{format_price($item->return)}} </h4>
                                                <small>Per {{$item->duration}} Hours</small>
                                            </div>
                                            <div class="text-end">
                                                <small >Gross Income</small>
                                                <h4 class="fw-bold mb-0">{{format_price($item->return * $item->days)}} </h4>
                                                <small>After {{$item->days}} Days</small>
                                            </div>
                                        </div>
                                        <a href="{{route('user.plan.buy', $item->slug)}}" class="btn btn-primary text-uppercase mt-2 w-100">Confirm Investment</a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
@section('styles')
<style>
    .plan-img{height: 300px; background-color: thistle}
</style>
@endsection
