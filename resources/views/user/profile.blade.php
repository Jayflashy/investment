@extends('user.layouts.master')

@section('title', 'My Account')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-pills" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home"
                        role="tab">Profile</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile"
                        role="tab">Bank Account</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link" data-bs-toggle="tab" href="#messages"
                        role="tab"></a>
                </li>

            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active p-3" id="home" role="tabpanel">
                    <div class="row g-3">
                        <div class="col-md-6 border border-primary p-2">
                            <form action="{{route('user.profile.update')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                <label class="form-label" for="fullname">Full Name</label>
                                <input class="form-control" required name="name" type="text" value="{{Auth::user()->name}}" placeholder="Full Name">
                                </div>
                                <div class="form-group mb-3">
                                <label class="form-label" for="Username">Username</label>
                                <input class="form-control" required name="Username" type="text" value="{{Auth::user()->username}}" readonly placeholder="Username">
                                </div>
                                <div class="form-group mb-3">
                                <label class="form-label" for="email">Email Address</label>
                                <input class="form-control" required id="email" type="text" value="{{Auth::user()->email}}" placeholder="Email Address" readonly>
                                </div>
                                <div class="form-group mb-3">
                                <label class="form-label" for="phone">Phone Numer</label>
                                <input class="form-control" required name="phone" type="tel" value="{{Auth::user()->phone}}" placeholder="Phone Number">
                                </div>
                                <div class="form-group mb-3">
                                <label class="form-label" for="address">Address</label>
                                <input class="form-control" name="address" type="text" value="{{Auth::user()->address}}" placeholder="Address">
                                </div>
                                <button class="btn btn-success w-100" type="submit">Update Now</button>
                            </form>
                        </div>
                        <div class="col-md-6 border border-info p-2">
                            <h5 class="fw-bold">Change Password</h5> <hr class="mt-0">
                            <form action="{{route('user.password.update')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Old Password</label>
                                    <div class="position-relative">
                                        <input class="form-control" id="psw-input" required name="old_password" type="password" placeholder="Enter Password">
                                        <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">New Password</label>
                                    <div class="position-relative">
                                        <input class="form-control" id="psw-input1" required name="new_password" type="password" placeholder="Enter Password">
                                        <div class="position-absolute" id="password-visibility1"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success w-100">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane p-3" id="profile" role="tabpanel">
                    <h5 class="fw-bold">Update Withdrawal Account</h5> <hr class="mt-0">
                    <form action="{{route('user.acct.update')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <p class="form-label">Bank Name</p>
                            <select name="bank_name" id="" required class="form-control select2 w-100" style="width: 100%">
                                <option value=""> Select Withdrawal Bank</option>
                                @if (Auth::user()->bank_name != null)
                                    <option value="{{Auth::user()->bank_name}}" selected>{{Auth::user()->bank_name}}</option>
                                @endif
                                @include('user.banklist')
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" value="{{Auth::user()->acc_number}}" class="form-control" required name="acc_number" placeholder="Account Number">
                        </div>
                        <div class="form-group">
                            <label for="">Account Name</label>
                            <input type="text"  value="{{Auth::user()->acc_name}}" required name="acc_name" placeholder="Account Name" class="form-control">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-success w-100">Update Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('styles')
<style>
.nav-link{
    margin-right: 20px;
}
</style>
@endsection
@section('script1')
<script src="{{static_asset('user/libs/select2/js/select2.min.js')}}"></script>
{{-- <script src="{{static_asset('user/js/pages/form-advanced.init.js')}}"></script> --}}
<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection
@section('style1')
<link href="{{static_asset('user/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
