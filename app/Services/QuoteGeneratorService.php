<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class QuoteGeneratorService implements QuoteGeneratorInterface
{

    public function randomQuoteGenerator()
    {
        $response = Http::get('https://zenquotes.io/api/random');
        // $response = Http::get('https://api.quotable.io/random');
        //to use zen quotable change the following 
        //'q' => $data['content'], 
        //'a' => $data['author'], 
        if ($response->successful()) {
            $data = $response->json();
            return [
                'quote' => $data[0]['q'], //paramter of quote
                'author' => $data[0]['a'],  // paramter of the Author
            ];
        } else {
            return ['q' => 'Postive self talk is like nurturing your soul', 'a' => 'Xx'];
        }
    }
}
