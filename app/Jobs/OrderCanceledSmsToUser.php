<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class OrderCanceledSmsToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $username;
    public $userPhoneNumber;
    public $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $orderId, $userPhoneNumber)
    {
        //
        $this->username = $username;
        $this->orderId = $orderId;
        $this->userPhoneNumber = $userPhoneNumber;
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
        Hi $this->username, Your order number [$this->orderId] has been canceled by your assigned biker. Please log into your account to confirm. Thank you.";

        
        Http::get('https://sms.arkesel.com/sms/api'.'?'.'action=send-sms'. '&api_key=S0l6dWdldGR2clVEYlFRYWRJa2U' .'&to='.$this->userPhoneNumber.'&from=CodeGod'. '&sms='. $message);
        //////////////
    }
}
