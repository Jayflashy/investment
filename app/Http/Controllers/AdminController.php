<?php

namespace App\Http\Controllers;

use App\Http\Middleware\User;
use App\Models\Deposit;
use App\Models\Mdeposit;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\SystemSetting;
use App\Models\Withdraw;
use Artisan;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Str;

class AdminController extends Controller
{
    //
    function index(){
        return view('admin.index');
    }
    // admin profile
    function profile()
    {
        return view('admin.profile');
    }
    function update_profile (Request $request){

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->withSuccess(__('Profile Updated Successfully.'));
    }

    // Plana
    function plans(){
        $plans = Plan::whereStatus(1)->get();
        return view('admin.plans.index',compact('plans'));
    }
    function create_plan(){
        return view('admin.plans.create');
    }
    function store_plan(Request $request){
        // validate requests
        $request->validate([
            // 'ref_bonus' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',
            'name' => 'required|string|max:191',
            'days' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:0',
            'return' => 'required|numeric|min:0',
        ]);
        $input = $request->all();
        $input['slug'] = uniqueSlug($request->name, 'plans');
        if($request->hasFile('image')){
            $ufile = $request->file('image');
            $filename = $request->name."-File-".Str::random(14).'.'.$ufile->getClientOriginalExtension();
            $ufile->move(public_path('uploads/plan'),$filename);
            $input['image'] = 'plan/'.$filename;
        }
        $plan = Plan::create($input);
        // return $plan;

        return redirect()->route('admin.plans')->withSuccess('Plan created Successfully');


    }
    function edit_plan($id){
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }
    function update_plan($id,Request $request){
        // validate requests
        $request->validate([
            // 'ref_bonus' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',
            'name' => 'required|string|max:191',
            'days' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:0',
            'return' => 'required|numeric|min:0',
        ]);
        $input = $request->all();
        if($request->hasFile('image')){
            $ufile = $request->file('image');
            $filename = $request->name."-File-".Str::random(14).'.'.$ufile->getClientOriginalExtension();
            $ufile->move(public_path('uploads/plan'),$filename);
            $input['image'] = 'plan/'.$filename;
        }
        $plan = Plan::FindOrFail($id)->update($input);
        // return $plan;

        return redirect()->route('admin.plans')->withSuccess('Plan Updated Successfully');


    }
    public function delete_plan ($id)
    {
        $package = Plan::findorFail($id);
        $package->status = 2;
        $package->save();

        return redirect()->route('package.index')->withSuccess('Package has ben deleted');
    }

    // Settings
    public function settings()
    {
        return view('admin.setup.index');
    }
    public function payment_settings()
    {
        return view('admin.setup.payment');
    }
    public function envkeyUpdate(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        return back()->withSuccess("Settings updated successfully");

    }
    function update_settings(Request $request){
        $input = $request->all();

        if($request->hasFile('favicon')){
            $image = $request->file('favicon');
            $imageName = 'favicon.png';
            $image->move(public_path('uploads'),$imageName);
            $input['favicon'] =$imageName;
        }
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = 'logo.png';
            $image->move(public_path('uploads'),$imageName);
            $input['logo'] =$imageName;
        }
        if($request->hasFile('touch_icon')){
            $image = $request->file('touch_icon');
            $imageName = 'touch.png';
            $image->move(public_path('uploads'),$imageName);
            $input['touch_icon'] =$imageName;
        }

        $setting = Setting::first();
        $setting->update($input);

        return redirect()->back()->with('success',__('Settings Updated Successfully.'));
    }

    function systemUpdate(Request $request)
    {
        $setting = SystemSetting::where('name', $request->name)->first();
        if($setting !=null){
            $setting->value = $request->value;
            $setting->save();
        }
        else{
            $setting = new SystemSetting;
            $setting->name = $request->name;
            $setting->value = $request->value;
            $setting->save();
        }

        return '1';
    }
    public function store_settings(Request $request)
    {
        // return $request;
        foreach ($request->types as $key => $type) {
            if($type == 'site_name'){
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            else {
                $sys_settings = SystemSetting::where('name', $type)->first();

                if($sys_settings!=null){
                    if(gettype($request[$type]) == 'array'){
                        $sys_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $sys_settings->value = $request[$type];
                    }
                    $sys_settings->save();
                }
                else{
                    $sys_settings = new SystemSetting;
                    $sys_settings->name = $type;
                    if(gettype($request[$type]) == 'array'){
                        $sys_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $sys_settings->value = $request[$type];
                    }
                    $sys_settings->save();
                }
            }
        }

        Artisan::call('cache:clear');

        return redirect()->back()->withSuccess(__('Settings Updated Successfully.'));
    }
    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }

    // Manual Paymentg

    public function manual_payment()
    {
        $payments = Mdeposit::orderByDesc('id')->get();
        return view('admin.reports.manual', compact('payments'));
    }
    // delete manual deposits
    public function manual_deposit_delete($id)
    {
        $mpayment = Mdeposit::findOrFail($id);
        $mpayment->status = 3;
        $mpayment->save();

        return back()->withSuccess("Payment has been rejected and deleted");

    }
    public function manual_deposit_pay($id)
    {
        $mpayment = Mdeposit::findOrFail($id);
        $user = $mpayment->user;
        if($mpayment->status == 1){
            return redirect()->route('admin.mpayment')->withError("Payment Already Approved");
        }else{
            $final = $mpayment['amount'] - sys_setting('bank_fee');
            // create deposit
            $deposit = new Deposit();
            $deposit->user_id = $user->id;
            $deposit->type = 'manual'; // 1- event, 2- form, 3-vote
            $deposit->gateway = "manual";
            $deposit->trx = $mpayment['code'];
            $deposit->message = $mpayment['message'];
            $deposit->amount = $final;
            $deposit->fee = 0;
            $deposit->status = 1;
            $deposit->save();

            // Add User Balance
            $user->balance = $user->balance + $final;
            $user->save();
            $mpayment->status = 1;
            $mpayment->save();
            return redirect()->route('admin.mpayment')->withSuccess("Payment Approved Successfully");
        }
    }

    // Withdrawals
    public function withdraw_request ()
    {
        $withdraws = Withdraw::where('status' , 0)->get();
        $title = "Withdraw Requests";
        return view('admin.withdraw.index',compact('withdraws','title'));
    }
    public function delete_withdrawal ($id)
    {
        $withdraws = Withdraw::findorFail($id);
        $withdraws->status = 2;
        $withdraws->save();
        return redirect()->back()->withSuccess('Withdraw request is deleted');
    }
    public function paid_withdraw ()
    {
        $withdraws = Withdraw::orderByDesc('id')->get();
        $title = "Withdrawal History ";
        return view('admin.withdraw.paid',compact('withdraws','title'));
    }
}
