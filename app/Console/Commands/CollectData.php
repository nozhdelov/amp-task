<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CollectData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prices:collect {symbol}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Collect price information';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $symbol = $this->argument('symbol');
        \App\Jobs\CollectPrices::dispatchNow($symbol);
        
        return 0;
    }
}
