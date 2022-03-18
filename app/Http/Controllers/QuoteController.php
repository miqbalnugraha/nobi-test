<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class QuoteController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = "https://api.chucknorris.io/jokes/random";
        
        $response = $client->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

        return response()
        ->json([
            'quote' => $responseBody->value,
            'source' => $responseBody->url,
        ]);
    }
}
