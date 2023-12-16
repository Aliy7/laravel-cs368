<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="max-w-lg mx-auto p-4 bg-white shadow-md rounded-lg">
        @if(isset($quote))
            <blockquote class="text-lg text-black-800 italic font-semibold">
                "{{ $quote['q'] }}"
            </blockquote>
            <cite class="block text-right mt-4 text-sm font-bold text-black-800">
                - {{ $quote['a'] }}
            </cite>
        @else
            <p class="text-lg text-gray-600">No quote available.</p>
        @endif
    </div>
</div>

{{-- <script type="text/javascript"> --}}
{{-- 
    const api_url = "https://zenquotes.io/api/quotes/";
    const refreshInterval = 300000; // 5 minutes in milliseconds
    
    async function getapi(url) {
      const response = await fetch(url);
      var data = await response.json();
      console.log(data);
      // Update the content with the new data here
    }
    
    // Initial API call
    getapi(api_url);
    
    // Periodically refresh content
    setInterval(() => {
      getapi(api_url);
    }, refreshInterval);
    
    </script>
      --}}