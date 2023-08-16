@extends('admin.layouts.master')
@section('title', 'Payment Settings')

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Flutterwave Payment</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-9">
                        <label class="form-label">Enable Fluttterwave</label>
                    </div>
                    <div class="col-md-3">
                        <label class="jdv-switch jdv-switch-success mb-0">
                            <input type="checkbox" onchange="updateSystem(this, 'flutter_payment')" @if(sys_setting('flutter_payment') == 1) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Enable Withdrawal</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-9">
                        <label class="form-label">Enable Withdrawal</label>
                    </div>
                    <div class="col-md-3">
                        <label class="jdv-switch jdv-switch-success mb-0">
                            <input type="checkbox" onchange="updateSystem(this, 'withdrawal')" @if(sys_setting('withdrawal') == 1) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Manual Bank Transfer</h5>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-9">
                        <label class="form-label">Enable Transfer</label>
                    </div>
                    <div class="col-md-3">
                        <label class="jdv-switch jdv-switch-success mb-0">
                            <input type="checkbox" onchange="updateSystem(this, 'bank_transfer')" @if(sys_setting('bank_transfer') == 1) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 fw-bold ">Flutter Credentials</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('admin.setting.env_key') }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="flutter">
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FLW_PUBLIC_KEY">
                        <label class="form-label">{{__('FLW PUBLIC KEY')}}</label>
                        <input type="text" class="form-control" name="FLW_PUBLIC_KEY" value="{{  env('FLW_PUBLIC_KEY') }}" placeholder="FLUTTERWAVE PUBLIC KEY" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="FLW_SECRET_KEY">
                        <label class="form-label">{{__('FLW SECRET KEY')}}</label>
                        <input type="text" class="form-control" name="FLW_SECRET_KEY" value="{{  env('FLW_SECRET_KEY') }}" placeholder="FLUTTERWAVE PUBLIC KEY" required>
                    </div>
                    <div class="form-group mb-0 text-end">
                        <button type="submit" class="w-100 btn btn-sm btn-primary">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4">
        <div class="card">
            <h5 class="card-header fw-bold mb-0">Bank Payment Details</h5>
            <div class="card-body">
                <form action="{{route('admin.setting.store_settings')}}" method="post" class="row">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="bank_name">
                        <label class="form-label">Bank Name</label>
                        <input type="text"class="form-control" name="bank_name" placeholder="Bank Name" value="{{sys_setting('bank_name')}}" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="account_name">
                        <label class="form-label">Account Name</label>
                        <input type="text"class="form-control" name="account_name" placeholder="Account Name" value="{{sys_setting('account_name')}}" required>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="account_number">
                        <label class="form-label">Account Number</label>
                        <input type="text"class="form-control" name="account_number" placeholder="Account Number" value="{{sys_setting('account_number')}}" required>
                    </div>
                    <div class="form-group  mb-0">
                        <button class="btn w-100 btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="card">
            <h5 class="card-header fw-bold mb-0">Payment Charges</h5>
            <div class="card-body">
                <form action="{{route('admin.setting.store_settings')}}" method="post" class="row">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="min_deposit">
                        <label class="form-label">Minimum Deposit</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="min_deposit" placeholder="Min Deposit" value="{{sys_setting('min_deposit')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">{{get_setting('currency')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="max_deposit">
                        <label class="form-label">Miaximum Deposit</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="max_deposit" placeholder="Max Deposit" value="{{sys_setting('max_deposit')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">{{get_setting('currency')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="min_withdraw">
                        <label class="form-label">Minimum Withdrawal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="min_withdraw" placeholder="Min Withdrawal" value="{{sys_setting('min_withdraw')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">{{get_setting('currency')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="max_withdraw">
                        <label class="form-label">Maximum Withdrawal</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="max_withdraw" placeholder="Max Withdrawal" value="{{sys_setting('max_withdraw')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">{{get_setting('currency')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="types[]" value="withdraw_charge">
                        <label class="form-label">Withdrawal Fee</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="withdraw_charge" placeholder="Withdrawal Fee" value="{{sys_setting('withdraw_charge')}}" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-info text-white">{{get_setting('currency')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-success w-100" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header h4">Currency Settings</div>
    <div class="card-body">
        <form class="row" action="{{route('admin.setting.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-sm-6 ">
                <label class="form-label">Currency Symbol</label>
                <input type="text" class="form-control" name="currency" value="{{get_setting('currency')}}" required placeholder="Currency Symbol"/>
            </div>
            <div class="form-group col-sm-6">
                <label class="form-label">Currency Code</label>
                <input type="text" class="form-control" name="currency_code" value="{{get_setting('currency_code')}}" required placeholder="Currency Code"/>
            </div>
            <div class="text-end">
                <button class="btn btn-success btn-block" type="submit">@lang('Update Setting')</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('breadcrumb')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">@yield('title')</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
@endsection

@section('scripts')
<script>
    function updateSystem(el, name){
        if($(el).is(':checked')){
            var value = 1;
        }
        else{
            var value = 0;
        }
        $.post('{{ route('admin.setting.sys_settings') }}', {_token:'{{ csrf_token() }}', name:name, value:value}, function(data){
            if(data == '1'){
                Snackbar.show({
                    text: '{{__('Settings Updated Successfully')}}',
                    pos: 'top-right',
                    backgroundColor: '#38c172'
                });
            }
            else{
                Snackbar.show({
                    text: '{{__('Something went wrong')}}',
                    pos: 'top-right',
                    backgroundColor: '#e3342f'
                });
            }
        });
    }
</script>
@endsection
@section('styles')
<style>
    .primage {
        max-height: 50px !important;
        max-width: 150px !important;
        margin: 0;
    }
    .card-header{border-top:1px solid #1d1f1d }

    /*switch*/
    .jdv-switch input:empty {
    height: 0;
    width: 0;
    overflow: hidden;
    position: absolute;
    opacity: 0;
    }
    .jdv-switch input:empty ~ span {
    display: inline-block;
    position: relative;
    text-indent: 0;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    line-height: 24px;
    height: 31px;
    width: 60px;
    border-radius: 12px;
    }
    .jdv-switch input:empty ~ span:after,
    .jdv-switch input:empty ~ span:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    content: " ";
    -webkit-transition: all 0.1s ease-in;
    transition: all 0.1s ease-in;
    width: 60px;
    border-radius: 12px;
    }
    .jdv-switch input:empty ~ span:before {
    background-color: #e8ebf1;
    }
    .jdv-switch input:empty ~ span:after {
    height: 27px;
    width: 27px;
    line-height: 20px;
    top: 2px;
    bottom: 2px;
    margin-left: 2px;
    font-size: 0.8em;
    text-align: center;
    vertical-align: middle;
    color: #89aaeb;
    background-color: #fff;
    }
    .jdv-switch input:checked ~ span:after {
    background-color: #3490dc;
    margin-left: 30px;
    }
    .jdv-switch-success input:checked ~ span:after {
    background-color: #38c172;
    }
    .jdv-switch-info input:checked ~ span:after {
    background-color: #6cb2eb;
    }
    .jdv-switch-warning input:checked ~ span:after {
    background-color: #ffed4a;
    }
    .jdv-switch-danger input:checked ~ span:after {
    background-color: #e3342f;
    }
    .switch-label{
    margin-top: 0;
    margin-bottom: .5rem;
    font-weight: 500;
    line-height: 1.4;
    font-size: 20px;
    color: #8480ae
    }
</style>
@endsection
