<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class CustomersController extends Controller
{
    public function getCustomers()
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers?page_size=100';
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        // dd($customers_data);

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

    public function getCustomer($id)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers?customer_id=' . $id;
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        // dd($customers_data);

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

    public function storeCustomers(Request $request)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers';

        request()->validate([
            'email_address' => ['required', 'email:rfc,dns'],
            'first_name' => 'required',
            'last_name' => 'required',
            'id_number' => 'required',
            'msisdn' => 'required',
            'pin_number' => 'required',
        ]);

        $data = [
            'customer_status' => 'ACTIVE',
            'email_address' => Str::lower(request()->email_address),
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'id_number' => request()->id_number,
            'msisdn' => request()->msisdn,
            'pin_number' => Str::upper(request()->pin_number),
        ];

        // dd($data);
        $customers_response = $this->to_curl($customers_url, $data);
        $customers_data = json_decode($customers_response);
        // dd($customers_data);

        $request->flash();

        if (empty($customers_data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } elseif (isset($customers_data->code)) {
            return redirect()->route('signin');
        } elseif (!isset($customers_data->response_code)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($customers_data->response_code == 200) {
                // dd($customers_data->resource->customer_id);
                return redirect()->route('lead.quotation.view', $customers_data->resource->customer_id);
            } else if ($customers_data->errors) {
                $data = json_decode($this->get_curl($customers_url . "?msisdn=" . request()->msisdn));
                // dd($data);
                // $customer_id = $data->results[0]->customer_id;
                // return redirect()->route('lead.quotation.view', $customer_id);
                return Redirect::back()->withErrors(['A customer with either the phone number or id number already exists in the system']);
            } else {
                return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
            }
        }
    }

    public function editCustomer()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers/' . (int)request('customer_id');
        // dd($url, Session::get('token'));

        $data = request()->validate([
            'customer_id' => ['required'],
            'record_version' => ['required'],
            'email_address' => ['required', 'email:rfc,dns'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'id_number' => ['required'],
            'customer_status' => ['required'],
            'msisdn' => ['required'],
        ]);

        $data = [
            'customer_id' => (int)request('customer_id'),
            'customer_status' => request()->customer_status,
            'email_address' => Str::lower(request()->email_address),
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'id_number' => request()->id_number,
            'pin_number' => Str::upper(request()->pin_number),
            'msisdn' => request()->msisdn,
            "record_version" => (int)request('record_version')
        ];

        // dd(json_encode($data));
        $response = $this->put_curl($customers_url, $data);
        // dd($response);

        $data = json_decode($response);

        // dd($data);
        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
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
            "tenure" => "required",
            "car_make" => "required",
            "car_model" => "required",
            "car_value" => "required",
            "use_type" => "required",
            "cover_type" => "required",
            "chassis_number" => "required",
            "year_of_registration" => "required"
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
            "tenure" => (int)request()->tenure,
            "car_make" => request()->car_make,
            "car_model" => request()->car_model,
            "car_value" => (int)request()->car_value,
            "use_type" => request()->use_type,
            "cover_type" => request()->cover_type,
            "chassis_number" => request()->chassis_number,
            "year_of_registration" => (int)request()->year_of_registration
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

        Session::put('customer_data', ["customer_id" => request()->customer_id, "customer_lead_id" => $customer_lead_id]);

        $cover = [
            "car_reg_number" => request()->car_reg_number,
            "customer_cover_status" => "CURRENT",
            "customer_id" => (int)request()->customer_id,
            "customer_lead_id" => (int)$customer_lead_id,
            "deposit" => (int)request()->deposit,
            "end_date" => strtotime(request()->end_date),
            "installment" => (int)request()->installment,
            "interest_rate" => (int)request()->interest_rate,
            "loan" => (int)request()->loan,
            "offer_id" => (int)request()->offer_id,
            "paid" => request()->paid,
            "premium" => (int)request()->premium,
            "start_date" => strtotime(request()->start_date),
            "tenure" => (int)request()->tenure,
            "use_type" => request()->use_type,
            "car_make" => request()->car_make,
            "car_model" => request()->car_model,
            "cover_type" => request()->cover_type,
            "car_value" => (int)request()->car_value,
            "chassis_number" => request()->chassis_number,
            "yearOfManufacture" => (int)request()->year_of_manufacture,
            "yearOfRegistration" => (int)request()->year_of_registration,
        ];

        $customers_cover_url = $this->url . 'customer_covers';
        $customers_cover_response = $this->to_curl($customers_cover_url, $cover);
        $customers_cover_data = json_decode($customers_cover_response);
        // dd($customers_cover_data, $cover, $customers_cover_url);

        // dd($customers_cover_data);

        if (empty($customers_cover_data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } elseif (isset($customers_cover_data->code)) {
            return redirect()->route('signin');
        } elseif (!isset($customers_cover_data->response_code)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($customers_cover_data->response_code == 200) {
                // dd($customers_cover_data->resource);
                return redirect()->route('lead.payment', $customers_cover_data->resource->customer_cover_id);
            } else if ($customers_cover_data->errors) {
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

        $quotation_data = Session::get('quotation_' . $id);
        $enum_data = Session::get('enum_data');

        $years = range(Carbon::now()->year, 2000);

        $enum_url = config('urls.auth') . '/api/v1/enums?enum_type=type_tenor_type';
        $enum_response = $this->get_curl($enum_url);
        $enum_data = json_decode($enum_response);

        // dd($enum_data);

        if (isset($offers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.lead_application', [
                'customers' => $customers_data->resource,
                'offers' => $offers_data->results,
                'quotation' => $quotation_data,
                'enum' => $enum_data,
                'years' => $years,
            ]);
        }
    }

    public function getLeadPaymentView($id = null)
    {

        $this->url = config('urls.url');
        $covers_url = $this->url . 'customer_covers?customer_cover_id=' . $id;
        $covers_response = $this->get_curl($covers_url);
        $covers_data = json_decode($covers_response);

        // dd($covers_data);

        if (isset($covers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.payment', [
                'cover' => $covers_data->results,
            ]);
        }
    }

    public function getCustomerLeadQuotationView($id = null)
    {
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customers/' . $id;
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

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

        // dd($enum_data);

        if (isset($offers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.lead_quotation', [
                'customers' => $customers_data->resource,
                'offers' => $offers_data->results,
                'categories' => $categories_data->results,
                'products' => $products_data->results,
                'tenor_types' => $enum_data->results
            ]);
        }
    }

    public function getCustomerCovers($id = null)
    {
        $this->url = config('urls.url');
        $single = null;
        if ($id) {
            $single = $id;
            $customers_url = $this->url . 'customer_covers?customer_id=' . $id . "&page_size=100";
        } else {
            $customers_url = $this->url . 'customer_covers?page_size=100';
        }
        $customers_response = $this->get_curl($customers_url);
        $customers_data = json_decode($customers_response);

        // dd($customers_data);

        if (isset($customers_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.customer_covers', [
                'customers' => $customers_data->results,
                'single' => $single
            ]);
        }
    }

    public function editCustomerCovers()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $customers_url = $this->url . 'customer_covers/' . (int)request('customer_cover_id');
        // dd($url, Session::get('token'));

        $data = request()->validate([
            "customer_cover_id" => ['required'],
            "car_reg_number" => ['required'],
            "premium" => ['required'],
            "deposit" => ['required'],
            "installment" => ['required'],
            "loan" => ['required'],
            "interest_rate" => ['required'],
            "customer_cover_status" => ['required'],
            "record_version" => ['required'],

        ]);


        $data = [
            "customer_cover_id" => (int)request('customer_cover_id'),
            "car_reg_number" => request('car_reg_number'),
            "premium" => (int)request('premium'),
            "deposit" => (int)request('deposit'),
            "installment" => (int)request('installment'),
            "loan" => (int)request('loan'),
            "interest_rate" => (int)request('interest_rate'),
            "record_version" => (int)request('record_version'),
        ];

        // dd(json_encode($data));
        $response = $this->put_curl($customers_url, $data);
        // dd($response);

        $data = json_decode($response);

        // dd($data);
        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
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

    public function getQuotation()
    {
        // dd(request()->all());

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
        // dd($url, $quote_data, $response);
        $data = json_decode($response);
        if (request('tenor') == "annually") {
            $end_date = Carbon::parse(request('start_date'))->addYear();
            $end_date = Carbon::parse($end_date)->format('d/m/y');
        }
        // dd($data);
        $quotation_data = (object)[
            'customer_id' => request()->customer_id,
            'dates' => (object)[
                'start_date' => Carbon::parse(request()->start_date)->format('d/m/y'),
                'end_date' => $end_date
            ],
            'data' => $data,
            'plate_number' =>  Str::upper(request()->plate_number),
            'vehicle_premium' => request()->vehicle_premium,
            "offer_id" => $offers_data->results[0]->offer_id,
            "car_value" => request()->value,
            "tenor" => request('tenor')
        ];

        // dd($quotation_data);
        Session::put('quotation_' . request()->customer_id, $quotation_data);
        return response()->json($data);
    }

    public function submitApplicationPayment()
    {
        // dd(request()->all());
        $this->url = config('urls.dispatcher');
        $payment_url = $this->url . 'disbursements';
        $phone = request()->payment_phone;
        $other_ref = null;

        // dd($payment_url);

        $payment_data = [
            "entries" => [
                (object)[
                    "source_paybill" => "7194405",
                    "transaction_type" => "STK",
                    "receiver_id" => "2",
                    "receiver" => "254" . substr($phone, 1),
                    "transaction_account" => "5186347",
                    "expected_name" => request()->expected_name,
                    "sent_amount" => (int)request()->deposit,
                    "account_reference" => "254" . substr($phone, 1),
                    "priority" => 1,
                ]
            ]
        ];

        // dd($payment_data);

        $payment_response = $this->payment_curl($payment_url, $payment_data);
        $payment_data = json_decode($payment_response);

        // dd($payment_data);
        if (!$payment_data) {
            Log::error("No response");
            $error_data = [
                'response_code' => 500,
                'message' => "No response"
            ];

            return response()->json($payment_data);
        } else if ($payment_data->response_code != 200) {
            return response()->json($payment_data);
        } else {
            $other_ref = $payment_data->resource->transactions[0]->other_ref;
        }

        $this->url = config('urls.url');
        $url = $this->url . 'customer_payments';

        // dd(Session::get('customer_data'));

        $user_data = [
            "amount" => (int)request()->deposit,
            "customer_cover_id" => (int)request()->cover_id,
            "customer_id" => (int)request()->customer_id,
            "customer_lead_id" => request()->customer_lead_id,
            "other_ref" => $other_ref,
            "payment_status" => "NEW"

        ];

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
