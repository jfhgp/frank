<?php

class FrankApi
{
    public function __construct()
    {
    }
//    AWS

    private $baseUrl = 'https://frank.hitechprime.io/api/v1/';

//    Local
//    private $baseUrl = 'http://localhost:3008/api/v1/';

//    Heroku
//    private $baseUrl = 'https://p-post.herokuapp.com/api/v1/';

//    private $baseUrl = 'http://18.193.69.136:3008/api/v1/';

    public function uploadImage($url, $data, $token = null, $method = "POST")
    {
        if (strcmp($method, "GET") == 0) {
            $url .= "?" . $data;
        }

        $curl = curl_init($this->baseUrl . $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        // curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        if ($token != null){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/x-www-form-urlencoded"
            ));
        }else{
            curl_setopt($curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/x-www-form-urlencoded" ));
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function doCurlRequest($url, $data, $token = null, $method = "POST")
    {
        if (strcmp($method, "GET") == 0) {
            $url .= "?" . $data;
        }

        $curl = curl_init($this->baseUrl . $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        // curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        if ($token != null){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/json"
            ));
        }else{
            curl_setopt($curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ));
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function patchCurlRequest($url, $data, $token)
    {
        $curl = curl_init($this->baseUrl . $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
        // curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        if ($token != null){
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/json"
            ));
        }else{
            curl_setopt($curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ));
        }
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function getRequests($url, $token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->baseUrl . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $token,
                "Content-Type: application/json"
            ),
        ));

        $responses = curl_exec($curl);

        curl_close($curl);
        return $responses;
    }

    public function doCurlDeleteRequest($url, $token)
    {
        $curl = curl_init($this->baseUrl . $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer " . $token,
            "Content-Type: application/json"
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}