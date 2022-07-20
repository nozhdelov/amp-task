<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PriceChanged extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $newPrice;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(float $newPrice)
    {
        $this->newPrice = $newPrice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.priceChanged')->with('newPrice', $this->newPrice);
    }
}
