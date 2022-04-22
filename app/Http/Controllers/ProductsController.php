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

        $categories_url = $this->url . 'categories?page_size=100';
        $categories_response = $this->get_curl($categories_url);
        $categories_data = json_decode($categories_response);
        // dd($products_data);

        if (isset($products_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.products', [
                'products' => $products_data->results,
                'categories' => $categories_data->results
            ]);
        }
    }

    public function storeProduct()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'products';

        $data = request()->validate([
            "category_id" => ['required'],
            "product_name" => ['required'],
            "product_status" => ['required']
        ]);

        $data = [
            "category_id" => (int)request()->category_id,
            "product_name" => request()->product_name,
            "product_status" => request()->product_status
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
