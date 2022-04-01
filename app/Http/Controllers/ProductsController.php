<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function getProducts()
    {
        $this->url = config('urls.url');
        $products_url = $this->url . 'products?page_size=100';
        $products_response = $this->get_curl($products_url);
        $products_data = json_decode($products_response);

        // dd($products_data);

        if (isset($products_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.products', ['products' => $products_data->results]);
        }
    }
}
