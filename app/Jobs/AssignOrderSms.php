<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class AssignOrderSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $bikerName;
    public $bikerPhoneNumber;
    public $orderId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($bikerName, $bikerPhoneNumber, $orderId)
    {
        //
        $this->bikerName = $bikerName;
        $this->bikerPhoneNumber = $bikerPhoneNumber;
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
        Hello $this->bikerName, the order with ID [$this->orderId] has been assigned to you to deliver. Please log into your account for more details. Thank you.";

        Http::get('https://sms.arkesel.com/sms/api'.'?'.'action=send-sms'. '&api_key=S0l6dWdldGR2clVEYlFRYWRJa2U' .'&to='.$this->bikerPhoneNumber.'&from=CodeGod'. '&sms='. $message);
        //////////////
    }
}
