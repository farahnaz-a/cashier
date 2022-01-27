<?php

namespace App\Http\Controllers;

use App\Events\Test;
use App\Models\GithubWebhooks;
use App\Models\Tester;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\WebhookClient\Models\WebhookCall;
use Artisan;

class GitPushController extends Controller
{
    public function index()
    {
        $data = WebhookCall::latest()->first();
      

        $payload = $data->payload;
        $payload['sender']['login']; 
        $payload['sender']['avatar_url'];
        $payload['after'];
        $payload['repository']['name'];
        $payload['commits'][0]['message'];
        $payload['commits'][0]['timestamp'];
        $payload['commits'][0]['url'];
        // foreach($payload as $pay)
        // {
        //     $payloads[] = $pay;
        // }
        // $jsons = json_decode($data);
        
        // foreach($jsons as $json)
        // {
        //     $payload[] = $json->payload;
        // }

        // foreach($payload as $pay)
        // {
        //     $payloads[] = json_decode($pay);
        // }

        // foreach($payloads as $payloader)
        // {
        //     // dd($payloader);
        //     echo $payloader->sender->login . '<br>'; 
        //     echo $payloader->sender->avatar_url . '<br>';
        //     if(isset($payloader->commits))
        //     {
        //         foreach($payloader->commits as $commit)
        //         {
        //             echo $commit->message . '<br>';
        //             echo Carbon::parse($commit->timestamp)->format('d M Y') . '<br>';
        //             // Get repo name
        //             echo $payloader->repository->name . '<br>';
        //             echo $commit->url . '<br>';
        //         }
        //     }
        // }
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


        public function fiscal()
        {
            return view('fiscal');

        }
             public function getresult()
        {


                   function downloadPage( $sURL, 
                     $iConnectionTimeOut = 110, 
                     $iTimeOut = 110,
                     $aHeaders = array(),
                     $sPostData = '')
             {
 
             $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
             $sContent = ''; 
             $ch = curl_init();
             !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
             !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';	
             if(!empty($sPostData))
             {
                     curl_setopt($ch, CURLOPT_POST, 1);
                     curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
             }
             curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
             curl_setopt($ch, CURLOPT_HEADER, false);  	
             curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
             curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
             curl_setopt($ch, CURLOPT_URL, $sURL);
             curl_setopt($ch, CURLOPT_ENCODING, "gzip");
             $sContent = curl_exec($ch);
             $aInfo = curl_getinfo($ch);
             curl_close($ch);
             $sContent = str_replace("\t","",$sContent);
             $sContent = str_replace("\r","",$sContent);
             $sContent = str_replace("\n","",$sContent);
             return $sContent;


             


             }








            $sFiscal  = isset($_GET['fiscal'])?$_GET['fiscal']:'';
            $sFacture  = isset($_GET['facture'])?$_GET['facture']:'';
            $aAnswer = [];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage($sURL);
            preg_match("/name=\"javax.faces.ViewState\" id=\"j_id__v_0:javax.faces.ViewState:1\" value=\"(.*?)\"/",$sHTML,$aData);
            $sViewState = isset($aData[1])?$aData[1]:'';
            $sPost = 'j_id_7%3Aspi='.$sFiscal.'&j_id_7%3Anum_facture='.$sFacture.'&j_id_7%3Aj_id_l=Valider&j_id_7_SUBMIT=1&javax.faces.ViewState='.urlencode($sViewState);
            $aHeaders = ['Host: cfsmsp.impots.gouv.fr',
                        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language: en-GB,en;q=0.5',
                        'Accept-Encoding: gzip, deflate, br',
                        'Referer: https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf',
                        'Content-Type: application/x-www-form-urlencoded',
                        'Origin: https://cfsmsp.impots.gouv.fr',
                        'DNT: 1',
                        'Connection: keep-alive',
                        'Upgrade-Insecure-Requests: 1',
                        'Sec-Fetch-Dest: document',
                        'Sec-Fetch-Mode: navigate',
                        'Sec-Fetch-Site: same-origin',
                        'Sec-Fetch-User: ?1'];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage( $sURL,110,110,[],$sPost);
            /*Parse Data*/
            preg_match("/Nom de naissance<\/td><td class=\"labelImpair\">(.*?)<\/td><td class=\"labelImpair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['declarant_1'] = isset($aData[1])?$aData[1]:'';
            $aAnswer['declarant_2'] = isset($aData[2])?$aData[2]:'';

            preg_match("/Nom<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['noms_declarant_1'] = isset($aData[1])?$aData[1]:'';
            $aAnswer['noms_declarant_2'] = isset($aData[2])?$aData[2]:'';
            
            preg_match("/Prénom\(s\)<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['prenoms_declarant_1'] = isset($aData[1])?$aData[1]:'';
            $aAnswer['prenoms_declarant_2'] = isset($aData[2])?$aData[2]:'';
            
            preg_match("/Adresse déclarée au (.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\"><\/td><\/tr><tr><td class=\"labelPair\"><\/td><td colspan=\"2\" class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['address_date'] = isset($aData[1])?strip_tags($aData[1]):'';
            $aAnswer['address_1'] = isset($aData[2])?$aData[2]:'';
            $aAnswer['address_2'] = isset($aData[3])?$aData[3]:'';
            
            preg_match("/Date de mise en recouvrement de l'avis d'impôt<\/td><td class=\"textPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['date_recouvrement'] = isset($aData[1])?$aData[1]:'';
            
            preg_match("/Date d\'établissement<\/td><td class=\"textImpair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['date_of_establishment'] = isset($aData[1])?$aData[1]:'';
            
            preg_match("/Nombre de personne\(s\) à charge<\/td><td class=\"textPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
            $aAnswer['nombre_de_personnes'] = isset($aData[1])?$aData[1]:'';
            
            preg_match("/Revenu fiscal de référence<\/td><td class=\"textImpair\">(.*?) €<\/td><\/tr></",$sHTML,$aData);
            $aAnswer['date_de_personnes'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',str_replace(' ','',$aData[1])):'';
            
            $aJSONAnswer = json_encode($aAnswer);
            header('Content-type: application/json');
            echo($aJSONAnswer); 
            // echo $aAnswer['declarant_1'] ."</n>";
            // echo $aAnswer['declarant_2'] ."</n>";
            // echo $aAnswer['address_1'] ."</n>";
            // echo $aAnswer['address_2'] ."</n>";
            echo $aAnswer['date_de_personnes'] ."</n>";
            // echo  gettype($aAnswer['date_de_personnes']);

       

            Tester::create([
                'declarant_1' => $aAnswer['declarant_1'],
                'declarant_2' => $aAnswer['declarant_2'],
                'address_1' => $aAnswer['address_1'],
                'address_2' => $aAnswer['address_2'],
                'number_of_child' => $aAnswer['nombre_de_personnes'] ?? 0, 
                'fiscal_amount'   =>  $aAnswer['date_de_personnes'] ?? 0,
            ]);



            // DB::table('crawlers')->insert([
            //     // 'nom_de_naissance_declarant_1 '   => $aAnswer['nom_de_naissance_declarant_1'] ,
            //     // 'nom_de_naissance_declarant_2 '   => $aAnswer['nom_de_naissance_declarant_2'],
            //     // 'address_1 '   => $aAnswer['address_1'] ,
            //     // 'address_2 '   => $aAnswer['address_2'],
            //     'nom_de_naissance_declarant_1 '   => 'asd' ,
            //     'nom_de_naissance_declarant_2 '   => 'adasd',
            //     'address_1 '   => 'asdsaf' ,
            //     'address_2 '   => 'asdfasf',
            // ]);


            // function downloadPage( $sURL, 
            //                         $iConnectionTimeOut = 110, 
            //                         $iTimeOut = 110,
            //                         $aHeaders = array(),
            //                         $sPostData = '')
            // {
        
            //         $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
            //         $sContent = ''; 
            //         $ch = curl_init();
            //         !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
            //         !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';	
            //         if(!empty($sPostData))
            //         {
            //                         curl_setopt($ch, CURLOPT_POST, 1);
            //                         curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
            //         }
            //         curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
            //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            //         curl_setopt($ch, CURLOPT_HEADER, false);  	
            //         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
            //         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            //         curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
            //         curl_setopt($ch, CURLOPT_URL, $sURL);
            //         curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            //         $sContent = curl_exec($ch);
            //         $aInfo = curl_getinfo($ch);
            //         curl_close($ch);
            //         $sContent = str_replace("\t","",$sContent);
            //         $sContent = str_replace("\r","",$sContent);
            //         $sContent = str_replace("\n","",$sContent);
            //         return $sContent;
            // }
        
        }


        public function check()
        {
            return view('check'); 
        }

        public function res()
        {

            Artisan::call('optimize:clear');

                function downloadPage( $sURL, 
                $iConnectionTimeOut = 110, 
                $iTimeOut = 110,
                $aHeaders = array(),
                $sPostData = '')
                {

                $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
                $sContent = ''; 
                $ch = curl_init();
                !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
                !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';	
                if(!empty($sPostData))
                {
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
                }
                curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_HEADER, false);  	
                curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE_FILE);
                curl_setopt($ch, CURLOPT_COOKIEFILE,COOKIE_FILE);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
                curl_setopt($ch, CURLOPT_URL, $sURL);
                curl_setopt($ch, CURLOPT_ENCODING, "gzip");
                $sContent = curl_exec($ch);
                $aInfo = curl_getinfo($ch);
                curl_close($ch);
                $sContent = str_replace("\t","",$sContent);
                $sContent = str_replace("\r","",$sContent);
                $sContent = str_replace("\n","",$sContent);
                return $sContent;
                }



            $sUser      = isset($_GET['user'])?$_GET['user']:'';
            $sPassword  = isset($_GET['password'])?$_GET['password']:'';
            define('COOKIE_FILE','/cookie.txt');
            $aAnswer = [];
            $sURL = 'https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD?t='.strtotime("-1 day");
            $sPost = 'pzAuth=guest&UserIdentifier='.urlencode($sUser).'&Password='.urlencode($sPassword).'&pyActivity%3DCode-Security.Login=&lockScreenID=&lockScreenPassword=&newPassword=&confirmNewPassword=';
            $aHeaders = ['Host: www.maprimerenov.gouv.fr',
                        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language: en-GB,en;q=0.5',
                        'Accept-Encoding: gzip, deflate, br',
                        'Referer: https://www.maprimerenov.gouv.fr/prweb/app/default/H9DF1ufnPCNDOGG8PFgaaW3tLvvaZHE9*/!STANDARD',
                        'Content-Type: application/x-www-form-urlencoded',
                        'Origin: https://www.maprimerenov.gouv.fr',
                        'DNT: 1',
                        'Connection: keep-alive',
                        'Upgrade-Insecure-Requests: 1',
                        'Sec-Fetch-Dest: document',
                        'Sec-Fetch-Mode: navigate',
                        'Sec-Fetch-Site: same-origin',
                        'Sec-Fetch-User: ?1',
                        'TE: trailers'];
            $sHTML = downloadPage( $sURL,110,110,$aHeaders,$sPost);
            $sHTML = html_entity_decode($sHTML);
            /*Parse Data*/
            preg_match("/Dossier .*?<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
            $aAnswer['dossier'] = isset($aData[1])?$aData[1]:'';
            preg_match("/Travaux<\/div><div.*?>(.*?)<\/div><\/div><\/div>/",$sHTML,$aData);
            $aAnswer['travaux'] = isset($aData[1])?$aData[1]:'';
            preg_match("/Adresse du logement à rénover<\/div><div.*?>(.*?)<\/div>/",$sHTML,$aData);
            $aAnswer['adresse'] = isset($aData[1])?strip_tags($aData[1]):'';
             
            preg_match_all("/RESERVE_SPACE='false'><span ><button   data-ctl='Button'.*?>(.*?)<\/button><\/span><\/div>/",$sHTML,$aData);
            $aAnswer['status_1'] = isset($aData[1][0])?$aData[1][0]:'';
            $aAnswer['status_2'] = isset($aData[1][1])?$aData[1][1]:'';
            
            preg_match("/Date limite de dépôt :<\/div><div.*?>(.*?)<\/div><\/div/",$sHTML,$aData);
            $aAnswer['date'] = isset($aData[1])?strip_tags($aData[1]):'';
            
            preg_match("/subvention<\/div><\/div><\/div><\/div><\/div><div.*?><span.*?><span.*?>(.*?)€<\/span><\/span><\/div><\/div>/",$sHTML,$aData);
            $aAnswer['price'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',$aData[1]):'';
            
            $aJSONAnswer = json_encode($aAnswer);
            header('Content-type: application/json');
            echo($aJSONAnswer);
            die();
        }
    }