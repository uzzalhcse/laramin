<?php

use App\Events\NotificationEvent;
use App\Models\Auth\User;
use App\Notifications\GeneralNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

if (! function_exists('is_admin')) {
    function is_admin(): bool
    {
        return Auth::check() && in_array('super_admin',Auth::user()->roles->pluck('slug')->toArray());
    }
}

if (! function_exists('is_user')) {
    function is_user(): bool
    {
        return Auth::check() && in_array('user',Auth::user()->roles->pluck('slug')->toArray());
    }
}


if (! function_exists('upload_file')) {
    function upload_file(Request $request,$key,$path = '/',$file_title = null): ?string
    {
        $filename_path = null;
        if ($request->hasFile($key)) {
            $destinationPath = '/uploads'.$path.Carbon::now()->month.'/';
            $file = $request->file($key);
            if ($file_title){
                $filename = time().'_'.Str::of($file_title)->lower()->kebab().'.'.$file->getClientOriginalExtension();
            } else{

                $filename = time().'_'.Str::of($file->getClientOriginalName())->lower()->kebab();
            }
            $filename_path = $destinationPath . $filename;
            $file->move(public_path() . $destinationPath, $filename);
        }
        return $filename_path;
    }
}

if (! function_exists('get_percentage')) {
    function get_percentage($number,$percentage)
    {
        return ($percentage / 100) * $number;
    }
}


if (! function_exists('paginate_if_required')) {
    function paginate_if_required($items)
    {
        if (isset(request()->page)){ // paginate if request has page query
            $items = $items->paginate(config('settings.pagination.per_page'));
        } else{
            $items = $items->take(20)->get();
        }
        return $items;
    }
}



if (! function_exists('send_sms')) {
    function send_sms($to,$msg)
    {
        return send_sms_infobip($to,$msg);
    }
}
if (! function_exists('send_sms_infobip')) {
    function send_sms_infobip($to,$msg)
    {
        $key = 'a64250e756e0d95a5f0d2c1fea07fa3b-014661dc-7aff-456b-9962-0564d01bc3c9';
        $response = Http::withHeaders([
            'Authorization' => "App a64250e756e0d95a5f0d2c1fea07fa3b-014661dc-7aff-456b-9962-0564d01bc3c9",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post('https://nzgz5y.api.infobip.com/sms/2/text/advanced', [
            'messages' => [
                [
                    'from' => 'ATC',
                    'destinations' => [
                        ['to' => $to]
                    ],
                    'text' => $msg,
                ]
            ]
        ]);

        return true;
    }
}


if (! function_exists('num_format')) {
    function num_format($number,$decimals = 3, $decimal_separator = '.', $thousands_separator = ''): float
    {
       return number_format($number, $decimals, $decimal_separator, $thousands_separator);
    }
}


