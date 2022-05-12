<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function home()
    {
        if (Session::get('token') != null) {
            $this->url = config('urls.auth');
            $url = $this->url . 'oauth/verify';

            $data = [
                "token" => Session::get('token'),
            ];

            $response = $this->to_curl($url, $data);
            $data = json_decode($response);

            // dd($data);

            if ($data->response_code == 200) {
                $customers_url = config('urls.url') . 'customer_covers?page_size=10';
                $customers_response = $this->get_curl($customers_url);
                $customers_data = json_decode($customers_response);

                $enum_url = config('urls.auth') . '/api/v1/enums?page_size=100';
                $enum_response = $this->get_curl($enum_url);
                $enum_data = json_decode($enum_response);

                if ($enum_data && $enum_data->response_code == 200) {
                    Session::put('enum_data', $enum_data->results);
                }

                return view('content.dashboard', ['customers' => $customers_data->results]);
            } else {
                // dd($data);
                return Redirect::back()->withErrors($data->errors[0]->message);
            }
        } else {
            return route('signin');
        }
    }

    public function signup()
    {
        return view('auth.register');
    }
    public function application()
    {
        return view('content.application');
    }

    public function profile()
    {
        if (Session::has('token')) {
            $token = Session::get('token');

            if (is_null(Session::get('resource'))) {
                return redirect()->route('login');
            } else {

                $data = [
                    'CustomerID' => Session::get('resource')['user_id'],
                ];

                $this->url = config('urls.url');
                $url = $this->url . 'userhistory';

                $status = json_decode(Http::asForm()->post($url, $data));
                // dd($status);

                if ($status->status == 1) {
                    return view('profile')->with('userhistory', $status->response_data);
                } else {
                    return redirect()->back()->withErrors($status->message);
                }
            }

            // dd($created);
        } else {
            return view('auth.login');
        }
    }

    public function getCalculator()
    {
        $this->url = config('urls.url');

        $offers_url = $this->url . 'offers?page_size=100';
        $offers_response = $this->get_curl($offers_url);
        $offers_data = json_decode($offers_response);

        $products_url = $this->url . 'products?page_size=100';
        $products_response = $this->get_curl($products_url);
        $products_data = json_decode($products_response);

        $categories_url = $this->url . 'categories?page_size=100';
        $categories_response = $this->get_curl($categories_url);
        $categories_data = json_decode($categories_response);

        $enum_url = config('urls.auth') . 'api/v1/enums?enum_type=type_tenor_type';
        $enum_response = $this->get_curl($enum_url);
        $enum_data = json_decode($enum_response);

        // dd($enum_data, Str::upper('gina'));


        // dd($offers_data);

        if (isset($offers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.calculator', [
                'offers' => $offers_data->results,
                'categories' => $categories_data->results,
                'products' => $products_data->results,
                'tenor_types' => $enum_data->results
            ]);
        }
    }

    public function Calculate()
    {
        $this->url = config('urls.no_auth_url');
        $url = $this->url . 'offers/quotation';
        $end_date = null;

        $offers_url = $this->url . 'offers?product_id=' . request()->product_id . '&category_id=' . request()->category_id;
        $offers_response = $this->get_curl($offers_url);
        $offers_data = json_decode($offers_response);

        // dd($url, "http://ipfx-api.wrightinteractives.com/api/offers/quotation");
        $quote_data = [
            "offer_id" => $offers_data->results[0]->offer_id,
            "premium" => request()->vehicle_premium
        ];

        $response = $this->to_curl($url, $quote_data);
        $data = json_decode($response);

        return response()->json($data);
    }

    public function submitApplication()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'api/v1/customer_leads';

        $data = request()->validate([
            "car_reg_number" => ['required'],
            "car_value" => ['required'],
            "chassis_number" => ['required'],
            "cover_type" => ['required'],
            "customer_cover_id" => ['required'],
            "customer_lead_status" => ['required'],
            "delivery_address" => ['required'],
            "deposit" => ['required'],
            "end_date" => ['required'],
            "licensed_passengers" => ['required'],
            "offer_id" => ['required'],
            "premium" => ['required'],
            "start_date" => ['required'],
            "tenure" => ['required'],
            "use_type" => ['required'],
            "year_of_manufacture" => ['required'],
            "year_of_registration" => ['required'],
        ]);

        $data = [
            "car_reg_number" => request()->car_reg_number,
            "balance" => 100,
            "car_value" => request()->car_value,
            "customer_lead_status" => "PENDING_PAYMENT",
            // "customer_id" => $customer_id,
            "deposit" => 10,
            "end_date" => request()->end_date,
            "installment" => 23,
            "interest_rate" => 10,
            "loan" => 100,
            "offer_id" => 1,
            "premium" => 3875,
            "start_date" => request()->start_date,
            "tenure" => 1
        ];

        $response = $this->to_curl($url, $data);
        $data = json_decode($response);
        $status = $data->code;
        $message = $data->message;

        return Redirect::back()->withErrors($message);
    }
}
