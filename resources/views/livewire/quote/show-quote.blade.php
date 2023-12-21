<div wire:poll.10000ms="refreshQuote" class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
    @if(isset($quote))
    <h1 class="font-bold text-blue-800"> Wisdom words:</h1>
        <blockquote class="text-lg text-black-800 italic font-semibold">
            "{{ $quote['quote'] }}"
        </blockquote>
        <cite class="block text-right mt-4 text-sm font-bold text-black-800">
            By- {{ $quote['author'] }}
        </cite>
    @else
        <p class="text-lg text-gray-600">No quote available.</p>
    @endif
</div>
