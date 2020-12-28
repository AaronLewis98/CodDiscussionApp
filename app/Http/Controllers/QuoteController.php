<?php

namespace App\Http\Controllers;

use App\Quote;

class QuoteController extends Controller
{
    /**
     * Handle Quote data and show quote of the day view.
     *
     * @param App\Quote The quote singleton class data to handle.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function quote(Quote $quote)
    {
        $quoteText = $quote->quote->contents->quotes[0]->quote;
        $quoteAuthor = $quote->quote->contents->quotes[0]->author;
        return view('quote', ['quote' => $quoteText, 'author' => $quoteAuthor]);
    }
}
