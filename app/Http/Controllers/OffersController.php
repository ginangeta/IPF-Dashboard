<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OffersController extends Controller
{
    public function getOffers()
    {
        $this->url = config('urls.url');
        $offers_url = $this->url . 'offers?page_size=100';
        $offers_response = $this->get_curl($offers_url);
        $offers_data = json_decode($offers_response);

        // dd($offers_data);

        $products_url = $this->url . 'products?page_size=100';
        $products_response = $this->get_curl($products_url);
        $products_data = json_decode($products_response);

        $categories_url = $this->url . 'categories?page_size=100';
        $categories_response = $this->get_curl($categories_url);
        $categories_data = json_decode($categories_response);


        if (isset($offers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.offers', [
                'offers' => $offers_data->results,
                'categories' => $categories_data->results,
                'products' => $products_data->results
            ]);
        }
    }
}
