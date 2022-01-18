<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GitPushController extends Controller
{
    public function index()
    {
        $data = DB::table('webhook_calls')->where('name', 'default')->latest()->get();
        $jsons = json_decode($data);
        
        foreach($jsons as $json)
        {
            $payload[] = $json->payload;
        }

        foreach($payload as $pay)
        {
            $payloads[] = json_decode($pay);
        }

        foreach($payloads as $payloader)
        {
            // dd($payloader);
            echo $payloader->sender->login . '<br>'; 
            echo $payloader->sender->avatar_url . '<br>';
            if(isset($payloader->commits))
            {
                foreach($payloader->commits as $commit)
                {
                    echo $commit->message . '<br>';
                    echo Carbon::parse($commit->timestamp)->format('d M Y') . '<br>';
                    // Get repo name
                    echo $payloader->repository->name . '<br>';
                    echo $commit->url . '<br>';
                }
            }
        }
    }

    public function scrape()
    {

            // $ch = curl_init();

            // curl_setopt($ch, CURLOPT_URL, "https://cfsmsp.impots.gouv.fr//secavis/"); 
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, array('j_id_7:spi' => '1784204702168','j_id_7:num_facture' => '2048a02287626'));
            // curl_setopt($ch, CURLOPT_HEADER, false);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          
            // $result = curl_exec($ch);
            // echo $result;

        }
}
