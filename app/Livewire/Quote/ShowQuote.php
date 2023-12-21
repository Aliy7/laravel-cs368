<?php

namespace App\Livewire\Quote;

use Livewire\Component;
use App\Services\QuoteGeneratorService;
use App\Services\QuoteGeneratorInterface;

class ShowQuote extends Component
{
    protected $listeners = ['refreshQuote' => 'fetchQuote'];
    public $quote;

    public function mount(QuoteGeneratorService $quoteGeneratorService)
    {
        $this->quote = $quoteGeneratorService->randomQuoteGenerator();
    }

    public function refreshQuote()
    {
        $this->quote = app(QuoteGeneratorService::class)->randomQuoteGenerator();
        $this->dispatch('refreshQuote');
    }
    public function render()
    {
        return view('livewire.quote.show-quote');
    }
}
