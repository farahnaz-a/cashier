<?php 
namespace App\Handler;

use Spatie\WebhookClient\ProcessWebhookJob; 

class WebhookHandler extends ProcessWebhookJob
{
    public function handle()
    {
        logger('I was here');
        // logger($this->webhookCall->payload);
    }
}