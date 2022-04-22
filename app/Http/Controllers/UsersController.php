<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function getUsers()
    {
        $this->url = config('urls.auth');
        $users_url = $this->url . 'api/v1/users?page_size=100';
        $users_response = $this->get_curl($users_url);
        $users_data = json_decode($users_response);
        // dd($users_data);

        $roles_url = $this->url . 'api/v1/roles?page_size=100';
        $roles_response = $this->get_curl($roles_url);
        $roles_data = json_decode($roles_response);
        // dd($roles_data);

        if (isset($users_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.users', [
                'users' => $users_data->results,
                'roles' => $roles_data->results
            ]);
        }
    }

    public function storeUser()
    {
        // dd(request()->all());
        $this->url = config('urls.auth');
        $users_url = $this->url . 'api/v1/users';

        $data = request()->validate([
            "user_name" => ['required'],
            "user_email" => ['required'],
            "user_msisdn" => ['required'],
            "new_password" => ['required'],
            "user_status" => ['required'],
            "user_first_name" => ['required'],
            "user_middle_name" => ['required'],
            "user_last_name" => ['required'],
        ]);

        $data = [
            "organisation_id" => 1,
            "country_id" => 1,
            "user_type" => "API USER",
            "user_name" => request('user_name'),
            "user_email" => request('user_email'),
            "user_msisdn" => request('user_msisdn'),
            "new_password" => request('new_password'),
            "user_status" => request('user_status'),
            "user_first_name" => request('user_first_name'),
            "user_middle_name" => request('user_middle_name'),
            "user_last_name" => request('user_last_name'),
        ];

        // dd($data);
        $response = $this->to_curl($users_url, $data);
        $data = json_decode($response);

        // dd($data);
        if ($data->response_code == 200) {
            $role_url = $this->url . 'api/v1/user_roles';

            $user_role_data = [
                "user_id" => $data->resource->user_id,
                "role_id" => request('role_id'),
                "user_role_status" => 'ACTIVE'
            ];

            $user_role_response = $this->to_curl($role_url, $user_role_data);
            $user_role_data = json_decode($user_role_response);

            if ($user_role_data->response_code == 200) {
                return Redirect::back();
            } else {
                return Redirect::back()->withErrors($user_role_data->errors[0]->message);
            }
        } else if ($data->response_code == 400) {
            $users_url = $this->url . 'api/v1/users?user_email=' . request('user_email');
            $users_response = $this->get_curl($users_url);
            $users_data = json_decode($users_response);
            // dd($users_data);
            $role_url = $this->url . 'api/v1/user_roles';

            $user_role_data = [
                "user_id" => $users_data->results[0]->user_id,
                "role_id" => request('role_id'),
                "user_role_status" => 'ACTIVE'
            ];

            $user_role_response = $this->to_curl($role_url, $user_role_data);
            $user_role_data = json_decode($user_role_response);

            if ($user_role_data->response_code == 200) {
                return Redirect::back();
            } else {
                return Redirect::back()->withErrors($user_role_data->errors[0]->message);
            }
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }

    public function editUser()
    {
        // dd(request()->all());
        $this->url = config('urls.url');
        $url = $this->url . 'users';

        $data = request()->validate([
            "category_id" => ['required'],
            "deposit_formulae" => ['required'],
            "installment_formulae" => ['required'],
            "interest_rate" => ['required'],
            "user" => ['required'],
            "user_status" => ['required'],
            "product_id" => ['required'],
            "tenure" => ['required'],
            "user_id" => ['required'],
            "record_version" => ['required'],
        ]);

        $data = [
            "category_id" => (int)request('category_id'),
            "deposit_formulae" => request('deposit_formulae'),
            "installment_formulae" => request('installment_formulae'),
            "interest_rate" => (int)request('interest_rate'),
            "user" => request('user'),
            "user_status" => request('user_status'),
            "product_id" => (int)request('product_id'),
            "tenure" => (int)request('tenure'),
            "user_id" => (int)request('user_id'),
            "record_version" => (int)request('user_id')
        ];

        // dd($data);
        $response = $this->put_curl($url, $data);
        dd($response);

        $data = json_decode($response);

        dd($data);
        if ($data->response_code == 200) {
            return Redirect::back();
        } else {
            return Redirect::back()->withErrors($data->errors[0]->message);
        }
    }
}
