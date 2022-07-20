<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pricePoint;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Models\PricePoint $pricePoint)
    {
        $this->pricePoint = $pricePoint;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $notifications = \App\Models\NotificationSetting::where('price', '<=', $this->pricePoint->last_price)->with('user')->get();
        
        foreach($notifications as $notification){
            Mail::to($notification->user->email)->send(new \App\Mail\PriceChanged($this->pricePoint->last_price));
            
        }
    }
}
