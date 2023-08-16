<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    function register(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'string|required',
            'email' => 'email|unique:users|string|required',
            'username' => 'string|unique:users|max:20|required|regex:/\w*$/|max:255|unique:users,username',
            'phone' => 'required|string|numeric|min:10|unique:users,phone',
            'password' =>'required|string|min:8',
        ]);
        if($request->referral){
            $refer = User::whereUsername($request->referral)->first();
            if($refer->username == null){
                return redirect()->route('index')->withError('Invalid referral link');
            }
        }
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->user_role = 'user';
        $user->password = Hash::make($request['password']);
        $user->ref_id = isset($request->referral) ?  $refer->id : 0;
        if(sys_setting('verify_email') == 0){
            $user->email_verified_at = date('Y-m-d H:m:s');
        }
        $user->save();
        auth()->login($user);
        return redirect()->route('user.index')->withSucess('Account Created Successful');

        // return $request;
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
