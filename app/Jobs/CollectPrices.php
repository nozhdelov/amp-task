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
        $request = new \Illuminate\Http\Client\PendingRequest();
        $response = $request->get(self::SERVICE_URL . '/' . $this->symbol, [])->json();
        if(!$response){
            Log::error('Invalid Response');
            return;
        }
        if(array_key_exists('message', $response)){
            Log::error($response['message']);
            return;
        }
        
        $pricePoint = new \App\Models\PricePoint();
        $pricePoint->symbol = $this->symbol;
        $pricePoint->last_price = $response['last_price'];
        $pricePoint->low = floatval($response['low']);
        $pricePoint->high = floatval($response['high']);
        $pricePoint->ask = floatval($response['ask']);
        $pricePoint->volume = doubleval($response['volume']);
        
        $pricePoint->save();
        
        \App\Jobs\SendNotifications::dispatch($pricePoint)->onQueue('notifications');
        
        return $pricePoint;
    }
}
