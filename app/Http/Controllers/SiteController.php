<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
                return view('content.dashboard');
            } else {
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
