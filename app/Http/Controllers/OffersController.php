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

    public function storeOffer()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'offers';

        $data = request()->validate([
            "category_id" => ['required'],
            "deposit_formulae" => ['required'],
            "installment_formulae" => ['required'],
            "interest_rate" => ['required'],
            "offer" => ['required'],
            "offer_status" => ['required'],
            "product_id" => ['required'],
            "tenure" => ['required'],
        ]);

        $data = [
            "category_id" => (int)request('category_id'),
            "deposit_formulae" => request('deposit_formulae'),
            "installment_formulae" => request('installment_formulae'),
            "interest_rate" => (int)request('interest_rate'),
            "offer" => request('offer'),
            "offer_status" => request('offer_status'),
            "product_id" => (int)request('product_id'),
            "tenure" => (int)request('tenure')
        ];

        // dd($data);
        $response = $this->to_curl($url, $data);
        $data = json_decode($response);

        // dd($data);
        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }
}
