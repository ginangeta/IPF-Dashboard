<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CustomersController extends Controller
{
    public function getCustomers()
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers?page_size=100';
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        $this->url = config('urls.message');
        $templates_url = $this->url . 'templates??page_size=100';
        $templates_response = $this->get_curl($templates_url);
        $templates_data = json_decode($templates_response);

        $channels_url = $this->url . 'channels??page_size=100';
        $channels_response = $this->get_curl($channels_url);
        $channels_data = json_decode($channels_response);

        // dd($customers_data);

        if (isset($customers_data->code)) {
            return redirect()->route('signin');
        } else {
            if ($customers_data->response_code == "403" || $templates_data->response_code == "403") {
                return Redirect::back()->withErrors(['You do not have permissions to view this page']);
            } else {
                return view('content.customers', [
                    'customers' => $customers_data->results,
                    'templates' => $templates_data->results,
                    'channels' => $channels_data->results,
                ]);
            }
        }
    }

    public function storeCustomers()
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers';

        request()->validate([
            'email_address' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'required',
            'msisdn' => 'required',
        ]);

        $data = [
            'customer_status' => 'ACTIVE',
            'email_address' => request()->email_address,
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'id_number' => request()->id_number,
            'msisdn' => request()->msisdn,
        ];
        $customers_response = $this->to_curl($customers_url, $data);
        $customers_data = json_decode($customers_response);
        // dd($customers_data->errors);

        if (empty($customers_data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } elseif (isset($customers_data->code)) {
            return redirect()->route('signin');
        } elseif (!isset($customers_data->response_code)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($customers_data->response_code == 200) {
                // dd($customers_data->resource->customer_id);
                return redirect()->route('lead.application', $customers_data->resource->customer_id);
            } else if ($customers_data->errors) {
                return Redirect::back()->withErrors(['Customer already exists']);
            } else {
                return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
            }
        }
    }

    public function storeCustomerLeads($id = null)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customer_leads';

        // dd(request()->all());

        request()->validate([
            "balance" => "required",
            "car_reg_number" => "required",
            "customer_id" => "required",
            "customer_lead_status" => "required",
            "deposit" => "required",
            "end_date" => "required",
            "installment" => "required",
            "interest_rate" => "required",
            "loan" => "required",
            "offer_id" => "required",
            "premium" => "required",
            "start_date" => "required",
            "tenure" => "required"
        ]);

        $data = [
            "balance" => (int)request()->balance,
            "car_reg_number" => request()->car_reg_number,
            "customer_id" => (int)request()->customer_id,
            "customer_lead_status" => request()->customer_lead_status,
            "deposit" => (int)request()->deposit,
            "end_date" => request()->end_date,
            "installment" => (int)request()->installment,
            "interest_rate" => (int)request()->interest_rate,
            "loan" => (int)request()->loan,
            "offer_id" => (int)request()->offer_id,
            "premium" => (int)request()->premium,
            "start_date" => request()->start_date,
            "tenure" => (int)request()->tenure
        ];
        $customers_response = $this->to_curl($customers_url, $data);
        $customers_data = json_decode($customers_response);
        // dd($customers_url, $data, $customers_data);
        if ($customers_data->response_code != 200) {
            $customers_data = json_decode($this->get_curl($customers_url . "?customer_id=" . request()->customer_id));
            $customer_lead_id = $customers_data->results[0]->customer_lead_id;
        } else {
            $customer_lead_id = $customers_data->resource->customer_lead_id;
        }

        $cover = [
            "car_reg_number" => request()->car_reg_number,
            "customer_cover_status" => "CURRENT",
            "customer_id" => (int)request()->customer_id,
            "customer_lead_id" => (int)$customer_lead_id,
            "deposit" => (int)request()->deposit,
            "end_date" => request()->end_date,
            "installment" => (int)request()->installment,
            "interest_rate" => (int)request()->interest_rate,
            "loan" => (int)request()->loan,
            "offer_id" => (int)request()->offer_id,
            "paid" => request()->paid,
            "premium" => (int)request()->premium,
            "start_date" => request()->start_date,
            "tenure" => (int)request()->tenure
        ];

        $customers_cover_url = $this->url . 'customer_covers';
        $customers_cover_response = $this->to_curl($customers_cover_url, $cover);
        $customers_cover_data = json_decode($customers_cover_response);
        // dd($customers_cover_data, $cover, $customers_cover_url);

        if (empty($customers_data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } elseif (isset($customers_data->code)) {
            return redirect()->route('signin');
        } elseif (!isset($customers_data->response_code)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($customers_data->response_code == 200) {
                // dd($customers_data->resource);
                return redirect()->route('customers.covers');
            } else if ($customers_data->errors) {
                return Redirect::back()->withErrors(['Lead already exists']);
            } else {
                return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
            }
        }
    }

    public function getCustomerLeadApplicationView($id = null)
    {

        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers/' . $id;
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        $offers_url = $this->url . 'offers?page_size=100';
        $offers_response = $this->get_curl($offers_url);
        $offers_data = json_decode($offers_response);

        // dd($offers_data);

        if (isset($offers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.lead_application', [
                'customers' => $customers_data->resource,
                'offers' => $offers_data->results,
            ]);
        }
    }


    public function getCustomerCovers($id = null)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customer_covers?page_size=100';
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        // dd($customers_data);

        if (isset($customers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.customer_covers', ['customers' => $customers_data->results]);
        }
    }

    public function getCustomerPayments($id = null)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customer_payments?page_size=100';
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        // dd($customers_data);
        if (isset($customers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.customer_payments', ['customers' => $customers_data->results]);
        }
    }

    public function submitApplicationPayment()
    {
        // dd('Here');
        $this->url = config('urls.url');
        $url = $this->url . 'customer_payments';

        // dd($url);

        $user_data = [
            "amount" => 10.0,
            "customer_cover_id" => (int)request()->cover_id,
            "customer_id" => 3,
            "customer_lead_id" => 3,
            "other_ref" => (string)rand(pow(10, 5 - 1), pow(10, 5) - 1),
            "payment_status" => "NEW"

        ];

        // dd($user_data);

        $response = $this->to_curl($url, $user_data);
        $data = json_decode($response);
        // dd($data);
        return response()->json($data);
    }

    public function calPoints()
    {
        // $ops = ["5", "2", "C", "D", "+"];
        $ops =  ["5", "-2", "4", "C", "D", "9", "+", "+"];

        $this->doPoints($ops);
    }

    public function doPoints($ops)
    {

        $result = 0;
        $score = [];

        foreach ($ops as $key => $op) {

            // dd($ops[$key]);
            if (is_numeric($ops[$key])) {
                array_push($score, (int)$ops[$key]);
            } else if ($ops[$key] == "C") {
                // dd($score, array_pop($score));

                print_r($score);
                array_pop($score);
                print_r($score);
                // array_pop($score);

            } else if ($ops[$key] == "D") {
                $item = (int)$score[count($score) - 1] * 2;
                array_push($score, $item);
            } else if ($ops[$key] == "+") {
                $score_item = ($score[count($score) - 1]) + ($score[count($score) - 2]);
                array_push($score, $score_item);
            }
        }

        // $result = array_reduce($score, 'reduceFunction');
        $result =  array_reduce($score, function ($a, $b) {
            return $a + $b;
        }, 0);

        dd($result);

        return ($result);
    }
}
