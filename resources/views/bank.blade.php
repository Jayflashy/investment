@extends('user.layouts.master')

@section('title', 'Deposit Money')

@section('content')
<div class="col-12">
    <div class="card">
        <h4 class="fw-bold card-header">Pay with Bank Transfer</h4>
        <div class="card-body">
            {{-- <p>Make transfer to any of these accounts to fund your wallet instantly ({{format_price(sys_setting('auto_fee'))}} charge applied).</p> --}}
            <b>PAYMENT INSTRUCTIONS</b>
            <P class="mb-0">Make your payment to the account below</P>
            <p>Your account would be funded as soon as we receive payment. ({{format_price(sys_setting('bank_fee'))}} charges applied).</p>
            <ul class="list-group my-2">
                <li class="list-group-item">BANK NAME: {{sys_setting('bank_name')}}</li>
                <li class="list-group-item">ACCOUNT NAME: {{sys_setting("account_name")}}</li>
                <li class="list-group-item">ACCOUNT NUMBER: {{sys_Setting("account_number")}}</li>
                <li class="list-group-item">AMOUNT: {{format_price($details['amount'])}}</li>
                {{-- <li class="list-group-item">YOU RECEIVE: {{format_price($details['amount'] - sys_setting('bank_fee'))}}</li> --}}
            </ul>
            <p>Your account will be deleted if you submit invalid <b>payment receipt</b>.</p>
            <p>Attach your payment receipt below</p>
            <form action="{{route('user.deposit.manual')}}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="" class="form-label">Account Name</label>
                    <input class="form-control" name="name" type="text" required placeholder="Name on Teller/Receipt" >
                </div>
                <div class="form-group">
                    <label for="" class="form-label">Payment Receipt</label>
                    <input class="form-control" name="document" type="file" accept="image/*" required onchange="preview_picture(event)" >
                </div>
                <div class="form-group text-center">
                    <img id="pimage" class="d-none b-image mb-2"/>
                </div>
                <div class="form-group mb-0 text-center">
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .b-image{
        min-height: 300px;
        max-height:100%;
        width: auto;
        max-width: 100%;
    }
    .form-group{margin-bottom: 15px;}
</style>
@endsection
@section('scripts')
<script>
    function preview_picture(event)
    {
        document.getElementById('pimage').classList.remove('d-none');
        var reader = new FileReader();
        reader.onload = function()
        {
            var output = document.getElementById('pimage');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@stop
