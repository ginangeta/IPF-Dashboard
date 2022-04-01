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

        if (isset($categories_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.categories', ['categories' => $categories_data->results]);
        }
    }
}
