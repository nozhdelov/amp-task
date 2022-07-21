<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notifications extends Controller
{
    public function add(Request $request, \Illuminate\Http\JsonResponse $response){
        
        $email = $request->get('email', '');
        $price = $request->get('price', '');
        
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        if(empty($email)){
            return $response->setData(['status' => 0, 'message' => 'Invalid Email']);
        }
        if(empty($price)){
            return $response->setData(['status' => 0, 'message' => 'Invalid Price']);
        }
        
        $notificationUser = \App\Models\NotificationUser::firstOrCreate(['email' => $email]);
        
        $notificationSetting = new \App\Models\NotificationSetting();
        $notificationSetting->price = floatval($price);
        
        $notificationUser->notificationSettings()->save($notificationSetting);
        
        return $response->setData(['status' => 1, 'message' => 'Notification Saved']);
        
    }
}
