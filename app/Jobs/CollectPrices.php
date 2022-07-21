<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CollectPrices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    const SERVICE_URL = 'https://api.bitfinex.com/v1/pubticker/';

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    private $symbol;
    
    public function __construct($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $response = \Illuminate\Support\Facades\Http::post(self::SERVICE_URL . '/' . $this->symbol, [])->json();
        if(!$response){
            throw new \Eception('Invalid Response');
        }
        if(array_key_exists('message', $response)){
            throw new \Exception($response['message']);
        }
        
        $pricePoint = new \App\Models\PricePoint();
        $pricePoint->symbol = $this->symbol;
        $pricePoint->last_price = $response['last_price'];
        $pricePoint->low = floatval($response['low']);
        $pricePoint->high = floatval($response['high']);
        $pricePoint->ask = floatval($response['ask']);
        $pricePoint->volume = doubleval($response['volume']);
        
        $pricePoint->save();
        
        $notifications = \App\Models\NotificationSetting::where('price', '<=', $pricePoint->last_price)->with('user')->get();
        \App\Jobs\SendNotifications::dispatch($pricePoint, $notifications)->onQueue('notifications');
        
        return $pricePoint;
    }
}
