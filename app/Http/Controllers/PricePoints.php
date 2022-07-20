<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PricePoints extends Controller
{
    
    const ALLOWED_TYPES = ['last_price', 'low' , 'high'];
    const ALLOWD_PERIODS = [0, 7, 30];


    public function index(Request $request, \Illuminate\Http\JsonResponse $response){

        $type = $request->get('type', '');
        $period = $request->get('period', '');
        
        if(!in_array($type, self::ALLOWED_TYPES)){
            return $response->setData(['status' => 0, 'message' => 'Invalid Type']);
        }
        if(!in_array($period, self::ALLOWD_PERIODS)){
            return $response->setData(['status' => 0, 'message' => 'Invalid Period']);
        }
        
        $startDate = \Carbon\Carbon::now()->subDays($period);
        $pricePoints = \App\Models\PricePoint::whereDate('created_at', '>=', $startDate)->get();
      
        
        $dataSet = $pricePoints->map(fn($point) => $point->{$type});        
        $labels = $pricePoints->map(fn($point) => $point->created_at);
        
        return $response->setData(['status' => 1, 'data' => [
            'points' => $dataSet,
            'labels' => $labels
        ]]);
    }
}
