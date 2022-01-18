<?php 
namespace App\Handler;

use App\Models\GithubWebhooks;
use Spatie\WebhookClient\ProcessWebhookJob; 

class WebhookHandler extends ProcessWebhookJob
{
    public function handle()
    {
        $data = $this->webhookCall;
    
        $payload = $data->payload;

    foreach($payload as $pay)
    {
        $payloads[] = json_decode($pay);
    }

    foreach($payloads as $payloader)
    {
        // dd($payloader);
        $call = new GithubWebhooks();
        $call =  $payloader->sender->login; 
        $call =  $payloader->sender->avatar_url;
        $call =  $payloader->after;
        if(isset($payloader->commits))
        {
            foreach($payloader->commits as $commit)
            {
                $call = $commit->message;
                $call = $commit->timestamp;
                // Get repo name
                $call =  $payloader->repository->name;
                $call =  $commit->url;
            }
        }
    }

    }
}