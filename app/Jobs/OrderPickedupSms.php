<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class OrderPickedupSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $username;
    public $phoneNumber;
    public $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $phoneNumber, $orderId)
    {
        //
        $this->username = $username;
        $this->phoneNumber = $phoneNumber;
        $this->orderId = $orderId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // sending picked up sms after ordering food
        
        $message = "
        Hello $this->username, Your order with ID [$this->orderId] has been picked up and is on the move!. You will be alerted when it arrives.";

        Http::get('https://sms.arkesel.com/sms/api'.'?'.'action=send-sms'. '&api_key=S0l6dWdldGR2clVEYlFRYWRJa2U' .'&to='.$this->phoneNumber.'&from=CodeGod'. '&sms='. $message);
        //////////////
    }
}
