<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    public function getCategories()
    {
        $this->url = config('urls.url');
        $categories_url = $this->url . 'categories?page_size=100';
        $categories_response = $this->get_curl($categories_url);
        $categories_data = json_decode($categories_response);
        // dd($categories_data);

        // $companies_url = $this->url . 'companies?page_size=100';
        // $companies_response = $this->get_curl($companies_url);
        // $companies_data = json_decode($companies_response);
        // dd($companies_data);

        if (isset($categories_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.categories', [
                'categories' => $categories_data->results
            ]);
        }
    }


    public function getCategoryProducts()
    {
        $this->url = config('urls.url');
        $products_url = $this->url . 'products?category_id=' . request()->category_id;
        $products_response = $this->get_curl($products_url);
        $products_data = json_decode($products_response);
        // dd($products_data->results);

        if (isset($products_data->code)) {
            return redirect()->route('signin');
        } else {
            return response($products_data->results, 200);
        }
    }

    public function storeCategories()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'categories';

        // dd($url);
        $data = request()->validate([
            "brief" => ['required'],
            "category_name" => ['required'],
            "category_status" => ['required'],
        ]);

        $data = [
            "brief" => request()->brief,
            "category" => request()->category_name,
            "category_status" => request()->category_status,
            "company_id" => 1
        ];

        // dd($data);

        $response = $this->to_curl($url, $data);
        $data = json_decode($response);

        // dd($data);
        // $status = $data->code;
        // $message = $data->message;

        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }


    public function editCategories()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'categories/' . request('category_id');

        // dd($url);
        $data = request()->validate([
            "category_id" => ['required'],
            "brief" => ['required'],
            "category" => ['required'],
            "category_status" => ['required'],
            "record_version" => ['required'],
        ]);

        $data = [
            "category_id" => (int)request()->category_id,
            "brief" => request()->brief,
            "category" => request()->category_name,
            "category_status" => request()->category_status,
            "record_version" => (int)request()->record_version,
            "company_id" => 1
        ];

        // dd($data);

        $response = $this->put_curl($url, $data);
        $data = json_decode($response);

        // dd($data);
        // $status = $data->code;
        // $message = $data->message;

        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }
}
