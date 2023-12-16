<?php

namespace App\Livewire\Quote;

use Livewire\Component;
use App\Services\QuoteGeneratorInterface;

class ShowQuote extends Component
{
    public $quote;

    public function mount(QuoteGeneratorInterface $quoteGeneratorService)
    {
        $quotes = $quoteGeneratorService->randomQuoteGenerator();
    $this->quote = $quotes[0] ?? ['q' => 'No quote available', 'a' => 'Unknown', 'h' => ''];
        $this->dispatch('qouteGenerated');
    }
    public function render()
    {
        return view('livewire.quote.show-quote');
    }
}
