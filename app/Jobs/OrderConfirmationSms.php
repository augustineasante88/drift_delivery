<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderConfirmationSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $orderId;
    public $name;
    public $phoneNumber;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId, $name, $phoneNumber)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // sending confirmation sms after ordering food
        
        $message = "
        Hello $this->name, We're happy to let you know that we've received your order and it is being processed. Your order ID is [$this->orderId]. Thank you for choosing Drift Delivery Service.";

        Http::get('https://sms.arkesel.com/sms/api'.'?'.'action=send-sms'. '&api_key=S0l6dWdldGR2clVEYlFRYWRJa2U' .'&to='.$this->phoneNumber.'&from=CodeGod'. '&sms='. $message);
        //////////////

    }
}
