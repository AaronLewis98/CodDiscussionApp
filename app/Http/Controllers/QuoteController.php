<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function quote(Quote $quote)
    {
        $quoteText = $quote->quote->contents->quotes[0]->quote;
        $quoteAuthor = $quote->quote->contents->quotes[0]->author;
        return view('quote', ['quote' => $quoteText, 'author' => $quoteAuthor]);
    }
}
