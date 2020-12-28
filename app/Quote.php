<?php

namespace App;

class Quote 
{
    public $quote;

    public function __construct()
    {
        //call to api setting quote variable to json response
        $handle = curl_init();
        $url = 'https://quotes.rest/qod?language=en';
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $this->quote = json_decode(curl_exec($handle));
        curl_close($handle);
    }
}
