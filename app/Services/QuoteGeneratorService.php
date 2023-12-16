<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuoteGeneratorService implements QuoteGeneratorInterface {


    public function randomQuoteGenerator()
    {
        $response = Http::get('https://zenquotes.io/api/random');
        // $response = Http::get('https://api.quotable.io/random');


        if ($response->successful()) {
            return $response->json();
        } else {
            return [['q' => 'No quote available', 'a' => 'Unknown']];
        }
    }
 

}
 