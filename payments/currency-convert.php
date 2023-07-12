<?php


function currencyConvert($amount, $from, $to){

    
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/fixer/convert?to=".$to."&from=".$from."&amount=".$amount,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: MVMsfl4GLQpTSPAB4IclnzZZO79qE0Sc"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $resData = (array)json_decode($response);

        return $resData['result'];


}


?>