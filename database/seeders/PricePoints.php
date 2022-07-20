<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricePoints extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        for($i = 10; $i >= 0; $i--){
            $date = \Carbon\Carbon::now()->subDays($i);
            for($j = 0; $j <= 10; $j++){
                $data[] = [
                    'symbol' => 'BTCUSD',
                    'last_price' => 23000 + mt_rand(-1000, 1000),
                    'low' => 23000 + mt_rand(-1000, 1),
                    'high' => 23000 + mt_rand(1, 1000),
                    'ask' => 23000 + mt_rand(-1000, 1000),
                    'volume' => 10000 + mt_rand(-1000, 1000),
                    'created_at' => $date->addMinutes($j)
                ];
            }
            
        }
        \Illuminate\Support\Facades\DB::table('price_points')->insert($data);
    }
}
