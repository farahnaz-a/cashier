<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\WebhookClient\Models\WebhookCall;

class ChargeSucceededJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

       /** @var \Spatie\WebhookClient\Models\WebhookCall */
       public $webhookCall;

       public function __construct(WebhookCall $webhookCall)
       {
           $this->webhookCall = $webhookCall;
       }
   
       public function handle()
       {
           $charge = $this->webhookCall->payload['data']['object'];
           $user = User::where('stripe_id', $charge['customer'])->first();
           if($user)
           {

               Payment::create([
                   'user_id' => $user->id,
                   'sub_total' => $charge['amount'] / 100,
                   'total' => $charge['amount'] / 100,
                   'stripe_id' => $charge['id'],
                ]);
            }
       }
}
