<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrganizationsController extends Controller
{
    public function getOrganizations()
    {
        $this->url = config('urls.auth');
        $organisations_url = $this->url . 'api/v1/organisations?page_size=100';
        $organisations_response = $this->get_curl($organisations_url);
        $organisations_data = json_decode($organisations_response);

        // dd($organisations_data);

        $countries_url = $this->url . 'api/v1/countries?page_size=100';
        $countries_response = $this->get_curl($countries_url);
        $countries_data = json_decode($countries_response);


        if (isset($organisations_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.organisations', [
                'organisations' => $organisations_data->results,
                'countries' => $countries_data->results
            ]);
        }
    }

    public function storeOrganization()
    {
        // dd(request()->all());
        $this->url = config('urls.auth');
        $url = $this->url . 'api/v1/organisations';

        $data = request()->validate([
            "country_id" => ['required'],
            "organisation_type" => ['required'],
            "organisation_code" => ['required'],
            "organisation_name" => ['required'],
            "organisation_email" => ['required'],
            "organisation_msisdn" => ['required'],
            "organisation_contact" => ['required'],
            "organisation_status" => ['required'],
        ]);

        $data = [
            "country_id" => (int)request('country_id'),
            "organisation_type" => request('organisation_type'),
            "organisation_code" => request('organisation_code'),
            "organisation_name" => request('organisation_name'),
            "organisation_email" => request('organisation_email'),
            "organisation_msisdn" => request('organisation_msisdn'),
            "organisation_contact" => request('organisation_contact'),
            "organisation_status" => request('organisation_status'),
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

    public function editOrganization()
    {
        // dd(request()->all());
        $this->url = config('urls.auth');
        $url = $this->url . 'api/v1/organisations/' . (int)request('organisation_id');
        // dd($url, Session::get('token'));

        $data = request()->validate([
            "organisation_id" => ['required'],
            "country_id" => ['required'],
            "record_version" => ['required'],
            "organisation_type" => ['required'],
            "organisation_code" => ['required'],
            "organisation_name" => ['required'],
            "organisation_email" => ['required'],
            "organisation_msisdn" => ['required'],
            "organisation_contact" => ['required'],
            "organisation_status" => ['required'],
        ]);

        $data = [
            "organisation_id" => request('organisation_id'),
            "country_id" => request('country_id'),
            "record_version" => request('record_version'),
            "organisation_type" => request('organisation_type'),
            "organisation_code" => request('organisation_code'),
            "organisation_name" => request('organisation_name'),
            "organisation_email" => request('organisation_email'),
            "organisation_msisdn" => request('organisation_msisdn'),
            "organisation_contact" => request('organisation_contact'),
            "organisation_status" => request('organisation_status'),
        ];

        // dd(json_encode($data));
        $response = $this->put_curl($url, $data);
        // dd($response);

        $data = json_decode($response);

        // dd($data);
        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }
}
