<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Jobs\CollectPrices;
use Illuminate\Support\Facades\Http;

class CollectPricesTest extends TestCase
{
    
    public function test_TheCollectPricesJobShouldThrowIfAnErrorMessageIsReceivedFromService()
    {
        Http::fake(Http::response([
                'message' => 'Error',
        ], 200));
        
        try {
            \App\Jobs\CollectPrices::dispatchNow('BTCUSD');
        } catch (\Exception $e){
            $this->assertInstanceOf(\Exception::class, $e);
        }
       
       
    }
    
    
    public function test_TheCollectPricesJobShouldReturnAPricePointModel()
    {
        Http::fake(Http::response([
                'last_price' => 1,
                'low' => 1,
                'high' => 1,
                'ask' => 1,
                'volume' => 1,
        ], 200));
        
        $pricePosint = \App\Jobs\CollectPrices::dispatchNow('BTCUSD');
        $this->assertInstanceOf(\App\Models\PricePoint::class, $pricePosint);
       
    }
}
