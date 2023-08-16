@extends('admin.layouts.master')
@section('title', "Create Plan")
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body ">
            @include('alerts.alerts')
            <form action="{{route('admin.plan.store')}}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-6">
                    <label class="form-label">@lang('Plan Name'):</label>
                    <input type="text" class="form-control form-control-lg"  name="name" placeholder="Name" required>
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label class="form-label" for="">Price {{get_Setting('currency')}}</label>
                    <input name="price" type="number" placeholder="Package Price" class="form-control form-control-lg" required>
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label class="form-label" for="">Investment Return {{get_Setting('currency')}}</label>
                    <input name="return" type="number" placeholder="Return Per Day" class="form-control form-control-lg" required>
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label class="form-label" for="">Duration (Hours)</label>
                    <input name="duration" id="duration" type="number" placeholder="Duration in Hours" class="form-control form-control-lg" required>
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label class="form-label" for="">Investment Days</label>
                    <input name="days" type="number" placeholder="Plan Days"  class="form-control form-control-lg" required>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="">Plan Image</label>
                    <input name="image" accept="image/*" type="file" class="form-control form-control-lg" required>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-block btn-success w-100">Create Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('styles')
    <style>
        .input-group-text{
            font-size:30px
        }
    </style>
@stop
