<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Mdeposit;
use App\Models\Plan;
use App\Models\User;
use App\Models\Withdraw;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    //
    function dashboard(){
        return view('user.index');
    }

    function my_account(){
        return view('user.profile');
    }
    function update_profile(Request $request){
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable|string',
        ]);
        // return $request;
        $user = Auth::User();
        $user->name = $request->name;
        // check if no user exists with the email and then save
        if(User::where('id','!=', $user->id)->where('phone', $request->phone)->first() == null){
            $user->phone = $request->phone;
        }else{
            return redirect()->back()->withError('Phone Number has been used');
        }
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->withSuccess('Profile updated successfully');
    }
    function update_password(Request $request){
        $request->validate([
            'old_password' => 'required|string|min:5',
            'new_password' => 'required|string|min:5'
        ]);
        $user = Auth::user();
        // check if pssword matches
        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->withSuccess('Password successfully changed');
        }
        return redirect()->back()->withError('Old Password is incorrect');
    }
    function update_account(Request $request){
        // return $request;
        $user = Auth::user();
        $user->bank_name = $request->bank_name;
        $user->acc_number = $request->acc_number;
        $user->acc_name = $request->acc_name;
        $user->save();
        return back()->withSuccess('Withdrawal Details Updated Successfully');
    }

    function plans(){
        $plans = Plan::whereStatus(1)->get();
        return view('user.plans', compact('plans'));
    }
    function invest_plan($slug){
        $plan = Plan::whereSlug($slug)->first();
        $user = Auth::user();
        if($user->balance < $plan->price){
            return redirect()->route('user.deposit')->withError('Insufficient Balance To Invest. Please Recharge Your Account');
        }
        return $plan;
    }

    // deposit Money
    function deposit(){
        return view('user.deposit');
    }
    function deposit_now(Request $request){
        $request->validate([
            'amount' => 'required|min:1',
            'gateway' => 'required|string',
        ]);
        $payment = new PaymentController;
        $user = Auth::user();
        $details['amount'] = $request->amount;
        $details['name'] = $user->name;
        $details['user_id'] = $user->id;
        $details['phone'] = $user->phone;
        $details['description'] = "Wallet Funding Payment";
        $details['gateway'] = $request->gateway;
        $details['email'] = $user->email;
        $request->session()->put('payment_data', $details);

        if($request->gateway == "flutter"){
            return $payment->initFlutter($request, $details);
        }elseif($request->gateway == "manual"){
            return view('bank', compact('details'));
        }
        return $request;
    }

    // deposit manual
    function deposit_manual(Request $request)
    {
        $details = $request->session()->get('payment_data');
        $user = Auth::user();
        $request->validate([
            'document' => 'required|mimes:png,jpg,jpeg',
            'name' => 'required|string',
        ]);
        $mpayment = new Mdeposit();
        $mpayment->user_id = $user->id;
        $mpayment->name = $request->name;
        $mpayment->amount = $details['amount'];
        $mpayment->code = getTrx(19);
        $mpayment->message = $details['description'];
        // upload document
        if ($request->hasFile('document')){
            $document = $request->file('document');
            $name = Str::random(22).'.jpg';
            $document->move(public_path('uploads/payment'),$name);
            $mpayment->image = "payment/".$name;
        }
        $mpayment->status =2;
        $mpayment->save();
        return redirect()->route('user.mdeposit')->withSuccess("Your Payment has been submited. Wallet will be funded once your payment has been confirmed by the admin");
    }

    function manual_deposit(){
        $mdeposit = Mdeposit::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.mdeposit',compact('mdeposit'));
    }
    public function deposit_history(){
        $deposits = Deposit::whereUserId(Auth::user()->id)->orderByDesc('id')->get();
        return view('user.deposits', \compact('deposits'));
    }

    // Withdraw Money
    function withdraw(){
        $withdraws = Withdraw::where('user_id', Auth::user()->id)->orderByDesc('id')->limit(200)->get();
        return view('user.withdraw', compact('withdraws'));
    }
    // submit withdraw request
    public function submit_withdraw(Request $request)
    {
        $min = sys_setting('min_withdraw');
        $max = sys_setting('max_withdraw');
        // validate
        $request->validate([
            'amount' => 'required|min:'.$min.'|numeric|max:'.$max,
            'message' => 'nullable'
        ]);
        $user = Auth::user();
        if($request->amount > $user->balance){
            return back()->withError('Withdrawal Amount is more than your balance. Please try again');
        }
        if(sys_setting('withdrawal') != 1){
            return back()->withError('Sorry Withrawal of money has been temporary closed. <br> Please Check Back Later');
        }
        $charge = \sys_setting('withdraw_charge');
        // return $request;
        $withdraw = new Withdraw();
        $withdraw->amount = $request->amount;
        $withdraw->code = \getTrx(15);
        $withdraw->message = $request->message ?? "Withdrwal request of $request->amount from $user->username";
        $withdraw->user_id = $user->id;
        $withdraw->charge = $charge;
        $withdraw->final = $request->amount - $charge;
        $withdraw->old_balance = $user->balance;
        $withdraw->new_balance = $user->balance - $request->amount;
        $withdraw->status = 0;
        $withdraw->save();
        // deduct user balance
        $user->balance = $user->balance - $request->amount;
        $user->save();
        // send withdrawal email
        return redirect()->route('user.withdraw')->withSuccess('Withdrawal has been placed successfully');
    }
}
