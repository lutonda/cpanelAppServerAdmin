<?php

namespace AppBundle\Application;

use Symfony\Component\HttpClient\HttpClient;

class RestClient
{

    public static function get($url){

        $client = HttpClient::create();
        $response = $client->request('GET', $url);

        $content = json_decode($response->getContent());

        return $content;
    }
    public static function post($url,$data){

        $client = HttpClient::create();
        $response = $client->request('POST', $url,['body' => $data]);

        $content = $response->getContent();
        var_dump($content);

        return $content;
    }
}