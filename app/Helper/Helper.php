<?php

use App\Models\{
    Setting, SystemSetting
};

if (!function_exists('static_asset')) {
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/assets/' . $path, $secure);
    }
}

//formats currency
if (!function_exists('format_price')) {
    function format_price($price)
    {
        $fomated_price = number_format($price, 2);
        $currency = get_setting('currency');
        return $currency .$fomated_price;
    }
}
function sym_price($price)
{
    $fomated_price = number_format($price, 2);
    $currency = get_setting('currency_code');
    return $currency . $fomated_price;
}
function format_number($price)
{
    $fomated_price = number_format($price, 2);
    return $fomated_price;
}

//return file uploaded via uploader
if (!function_exists('my_asset')) {
    function my_asset($path, $secure = null)
    {
        return app('url')->asset('public/uploads/' . $path, $secure);
    }
}

function text_trim($string, $length = null)
{
    if (empty($length)) $length = 100;
    return Str::limit($string, $length, "...");
}


if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        $settings = Setting::first();
        $setting = $settings->$key;
        return $setting;
    }
}
if (!function_exists('sys_setting')) {
    function sys_setting($key, $default = null)
    {
        $settings = SystemSetting::all();
        $setting = $settings->where('name', $key)->first();

        return $setting == null ? $default : $setting->value;
    }
}

function slug($string)
{
    return Illuminate\Support\Str::slug($string);
}
// Create slug
function uniqueSlug($name ,$model)
{
    $slug = Str::slug($name);
    $allSlugs = checkRelatedSlugs($slug , $model);
    if (! $allSlugs->contains('slug', $slug)){
        return $slug;
    }

    $i = 1;
    $is_contain = true;
    do {
        $newSlug = $slug . '-' . $i;
        if (!$allSlugs->contains('slug', $newSlug)) {
            $is_contain = false;
            return $newSlug;
        }
        $i++;
    } while ($is_contain);
}
function checkRelatedSlugs($slug , $model)
{
    return DB::table($model)->where('slug', 'LIKE', $slug . '%')->get();
}
// random string
function getTrxcode($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getTrx($length)
{
    $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ1234567890acdefghijklmopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function show_datetime($date, $format = 'd M, Y h:ia')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

function show_date($date, $format = 'd M, Y')
{

    return \Carbon\Carbon::parse($date)->format($format);
}

function show_time($date, $format = 'h:ia')
{

    return \Carbon\Carbon::parse($date)->format($format);
}
