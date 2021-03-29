<?php
namespace App\Github;


class CurlHelper 
{
  
    static function getFeed($url, $request, $token, $username)
    {   
        $headers = [
            'Accept: application/vnd.github.v3+json',
            'User-Agent: ' . $username
        ];

        if($token){
            $headers[] = 'Authorization: token ' . $token; 
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => $request,
          CURLOPT_HTTPHEADER => $headers,
          CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    
}
