<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    HomeController,
    UserController,
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);
Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/home', 'index')->name('home');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/policy', 'policy')->name('policy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/page/{slug}', 'pages')->name('page');
    Route::get('/contact', 'contact_us')->name('contact');
    Route::post('/contact', 'send_contact')->name('contact');
});

// User Routes
Route::middleware('user')->as('user.')->controller(UserController::class)->group(function(){
    Route::get('/user', 'dashboard')->name('index');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/my-account', 'my_account')->name('setting');
    Route::post('/profile', 'update_profile')->name('profile');
    Route::post('/password/u', 'update_password')->name('password.update');
    Route::post('/account', 'update_account')->name('acct.update');
    Route::get('/plans', 'plans')->name('plans');
    Route::get('/plan/{slug}', 'invest_plan')->name('plan.buy');
    // deposit
    Route::get('/deposit', 'deposit')->name('deposit');
    Route::post('/deposit', 'deposit_now')->name('deposit.fund');
    Route::post('/deposit/manual', 'deposit_manual')->name('deposit.manual');
    // withdrawal
    Route::get('/withdraw', 'withdraw')->name('withdraw');
    Route::get('/withdraw/history', 'withdraw_history')->name('withdraw.history');
    Route::post('/withdraw/submit', 'submit_withdraw')->name('withdraw.submit');
    Route::get('/myteam', 'dashboard')->name('myteam');
    Route::post('profile','update_profile')->name('profile.update');
    // History
    Route::get('/manual-deposit', 'manual_deposit')->name('mdeposit');
    Route::get('/deposit-history', 'deposit_history')->name('deposit.history');
});

// Admin Route
Route::middleware('admin')->as('admin.')->prefix('admin')->group(function(){

    Route::controller(AdminController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/profile', 'profile')->name('profile');
        Route::post('/profile', 'update_profile')->name('profile');
        // Plans
        Route::get('/plans', 'plans')->name('plans');
        Route::get('/plan/create', 'create_plan')->name('plan.create');
        Route::get('/plan/edit/{id}', 'edit_plan')->name('plan.edit');
        Route::post('/planstore', 'store_plan')->name('plan.store');
        Route::post('/plan/update/{id}', 'update_plan')->name('plan.update');
        Route::get('/plan/del/{id}', 'delete_plan')->name('plan.delete');
        // Deposit
        Route::get('/deposits', 'deposit_history')->name('deposit');
        // Mpayment
        Route::get('/mpayment', 'manual_payment')->name('mpayment');
        Route::get('/mpayment/pay/{id}', 'manual_deposit_pay')->name('mpayment.pay');
        Route::get('/mpayment/del/{id}', 'manual_deposit_delete')->name('mpayment.delete');
        Route::post('profile','update_profile')->name('profile.update');

    });
    // Users
    Route::controller(AdminController::class)->as('members.')->prefix('members')->group(function(){
        Route::get('/' , 'members')->name('index');
        Route::get('/view/{id}' , 'view_member')->name('view');
        Route::get('/edit/{id}' , 'edit_member')->name('edit');
        Route::get('/withdrawals/{id}' , 'member_withdraw')->name('withdrawals');
        Route::get('/deposits/{id}' , 'member_deposit')->name('deposits');
        Route::get('/deposits/pay/{id}' , 'member_deposit_pay')->name('manual.pay');
        Route::get('/deposits/delete/{id}' , 'member_deposit_delete')->name('manual.delete');
        Route::get('/referrals/{id}' , 'member_referral')->name('referrals');
        Route::get('/transactions/{id}' , 'member_trx')->name('transactions');
        Route::get('/delete/{id}' , 'delete_member')->name('delete');
        Route::get('/ban/{id}/{status}' , 'ban_member')->name('ban');
        Route::post('/edit/{id}' , 'update_member')->name('update');
    });
    // Withdrawals
    Route::controller(AdminController::class)->as('withdraw.')->prefix('withdraw')->group(function(){
        Route::get('/' , 'withdraw_request')->name('requests');
        Route::get('/paid' , 'paid_withdraw')->name('paid');
        Route::get('/pay/{id}' , 'pay_withdrawal')->name('pay');
        Route::get('/delete/{id}' , 'delete_withdrawal')->name('delete');
    });
    // Settings
    Route::controller(AdminController::class)->as('setting.')->prefix('settings')->group(function(){
        Route::get('/payment' , 'payment_settings')->name('payment');
        Route::get('/features' , 'features')->name('features');
        Route::get('/custom-styles' , 'custom_styles')->name('custom');
        Route::get('/' , 'settings')->name('index');

        Route::post('/update', 'update_settings')->name('update');
        Route::post('/system', 'systemUpdate')->name('sys_settings');
        Route::post('/system/store', 'store_settings')->name('store_settings');
        Route::post('env_key', 'envkeyUpdate')->name('env_key');
    });
});
