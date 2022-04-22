<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //

    public function signin()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $this->url = config('urls.auth');
        $url = $this->url . 'oauth/token';

        $data = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => 'required',
        ]);

        $data = [
            'consumer_key' => $request->username,
            'consumer_secret' => $request->password,
        ];

        $response = $this->token_curl($url, $data);
        $data = json_decode($response);
        // dd($data);

        if (empty($data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            $status = $data->response_code;
            $message = $data->message;
            $previous_url = null;
            if ($status == 200) {
                $auth = $data;

                $this->url = config('urls.auth');
                $permission_url = $this->url . 'oauth/verify';

                Session::put('token', $auth->token);
                Session::put('lifetime', $auth->lifetime);

                $endOfLifetime = Carbon::now()->timezone('Africa/Nairobi')->addSeconds($auth->lifetime)->format('F d Y H:i:s');

                // dd($endOfLifetime);
                Session::put('endOfLifetime', $endOfLifetime);

                $permission_data = [
                    'Authorization' => 'Bearer' . Session::get('token')
                ];

                $permission_response = $this->to_curl($permission_url, $permission_data);
                $permission_data = json_decode($permission_response);

                if ($permission_data->response_code == 200) {
                    $permission_data = $permission_data->claims;

                    $product = $permission_data;

                    Session::put('resource', $product);
                    Session::put('user_id', $permission_data->user_id);
                    Session::save();

                    if (Session::get('Reset')) {
                        return redirect()->route('password.new');
                    } else {
                        $previous_url = Session::get('previous_url');

                        if (is_null($previous_url)) {
                            return redirect()->route('home');
                        } else {
                            return redirect()->intended($previous_url);
                        }
                    }
                }
            } else {
                // return redirect()->route('home');
                return Redirect::back()->withErrors($data->message->messages);
            }
        }
    }

    public function registration(Request $request)
    {

        $this->url = config('urls.url');
        $url = $this->url . 'register';

        // $url = 'http://dashboards.revenuesure.co.ke/Authentication/api/'.'Account/Register';


        $validatedData = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'OtherName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'email', 'max:255'],
            'PhoneMobile' => ['required'],
            'Password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => ['required', 'min:6'],
            'role' => ['required', 'string'],
            'roles_List' => ['required'],
        ]);


        if (str_contains($request->OtherName, ' ')) {
            $name_array =  explode(" ", $request->OtherName);
        } else {
            $name_array[1] = $request->OtherName;
            $name_array[0] = " ";
        }

        if (sizeof($name_array) < 2) {
            return redirect()->back()->withErrors('Please enter your full name');
        }

        // dd($name_array);
        $data = [
            'FirstName' => $request->FirstName,
            'MiddleName' => $name_array[0],
            'LastName' => $name_array[1],
            'Email' => $request->Email,
            'PhoneMobile' => $request->PhoneMobile,
            'Password' => $request->Password,
        ];

        // dd($data);

        $response = Http::asForm()->post($url, $data);
        $this->data['regData'] = json_decode($response);
        // dd($this->data);
        $status = $this->data['regData']->status;
        $message = $this->data['regData']->message;

        if (empty($this->data['regData'])) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($status == 1) {
                return Redirect::route('signin')->with('success', 'You have been registered successfully. Log in to access services.');
            } else {
                return Redirect::back()->withErrors($message);
            }
        }
    }

    public function changeUserDetails(Request $request)
    {

        $this->url = config('urls.url');
        $url = $this->url . 'edit';

        // $url = 'http://dashboards.revenuesure.co.ke/Authentication/api/'.'Account/Register';


        $validatedData = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'OtherName' => ['required', 'string', 'max:255'],
            'Email' => ['required', 'email', 'max:255'],
            'PhoneMobile' => ['required'],
        ]);

        if (str_contains($request->OtherName, ' ')) {
            $name_array =  explode(" ", $request->OtherName);
        } else {
            $name_array[1] = $request->OtherName;
            $name_array[0] = " ";
        }

        $data = [
            'FirstName' => $request->FirstName,
            'MiddleName' => $name_array[0],
            'LastName' => $name_array[1],
            'Email' => $request->Email,
            'PhoneMobile' => $request->PhoneMobile,
        ];

        // dd($data);

        $response = Http::asForm()->post($url, $data);
        $this->data['regData'] = json_decode($response);
        // dd($this->data);
        $status = $this->data['regData']->status;
        $message = $this->data['regData']->message;

        if (empty($this->data['regData'])) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($status == 1) {
                return Redirect::back()->with('success', $message);
            } else {
                return Redirect::back()->withErrors($message);
            }
        }
    }

    public function forgotPassword()
    {
        return view('auth.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (is_null(Session::get('resource'))) {
            return redirect()->route('signin');
        } else {

            $user_id = Session::get('resource')['user_id'];

            $data = [
                'Email' => Session::get('resource')['email'],
            ];

            $this->url = config('urls.url');
            $url = $this->url . 'forgetpassord';

            $status = json_decode(Http::asForm()->post($url, $data));

            // dd($status);

            return response()->json($status);
        }
    }

    public function changeForgotPassword(Request $request)
    {

        $data = [
            'Email' => $request->email,
        ];

        $this->url = config('urls.url');
        $url = $this->url . 'forgetpassord';

        $status = json_decode(Http::asForm()->post($url, $data));

        // return response()->json($status);
        if ($status->status != 1) {
            return Redirect::route('password.new')->with('error', $status->message);
        } else {

            Session::put('Useremail', $request->email);
            return Redirect::route('password.new')->with('success', $status->message);
        }
    }

    public function resetPassword(Request $request)
    {
        if (is_null(Session::get('resource'))) {

            $UserEmail = Session::get('Useremail');
        } else {

            $UserEmail = Session::get('resource')['email'];
        }

        $old_password = $request->oldPassword;
        $new_password = $request->newPassword;
        $repeat_password = $request->repeatPassword;
        $token = $request->_token;

        $data = [
            'Email' => $UserEmail,
            'OldPassword' => $old_password,
            'NewPassword' => $new_password,
            'RetypePassword' => $repeat_password,
        ];

        $this->url = config('urls.url');
        $url = $this->url . 'changepassord';

        $status = json_decode(Http::asForm()->post($url, $data));

        // dd($status);

        if (empty($status)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($status->status == 1) {
                return Redirect::route('signin')->with('success', 'You have been successfully changed your password. Log in to access services.');
            } else {
                return Redirect::back()->withErrors($status->message);
            }
        }
    }

    public function newPassword()
    {
        return view('auth.newpassword');
    }


    public function userResetPassword(Request $request)
    {
        // dd($request->all());
        $url = config('global.url') . 'user/forgot_password/';
        // dd($url);

        $data = [
            'email' => Session::get('user')->username,
        ];

        // dd($data);

        $response = Http::post($url, $data);
        // dd($response);

        $created = json_decode($response->body());

        // dd($created);

        if (is_null($created)) {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if (!$created->success) {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);

        return view('auth.change-password')->with('success', $created->msg);
    }

    public function otpLogin()
    {
        // dd($request->all());
        $url = config('global.url') . 'otp_login/';
        // dd($url);

        $phone = Session::get('userphone');

        $data = [
            'phone' => $phone,
        ];

        // dd($data);

        $response = Http::post($url, $data);
        // dd($response);

        $created = json_decode($response->body());

        // dd($created);

        if (is_null($created)) {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if (!$created->success) {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);

        return redirect()->route('otp', [
            'phoneNumber' => $phone
        ]);
    }

    public function validateOTP(Request $request)
    {
        // dd($request->all());
        $url = config('global.url') . 'validate_otp/';
        // dd($url);

        $data = [
            'phone' => $request->phone,
            'otp' => $request->otp,
        ];

        // dd($data);

        $response = Http::post($url, $data);
        // dd($response);
        $created = json_decode($response->body());
        // dd($created);

        if (is_null($created)) {
            return redirect()->back()->with('errors', 'An error occured.');
        }

        if (!$created->success) {
            return redirect()->back()->with('errors', $created->msg);
        }

        // dd($created);
        Session::put('user', $created->data->data);
        Session::put('Usertoken', $created->data->data->token);

        return redirect()->route('details');
    }

    public function logout()
    {
        Session::flush('token');
        Session::flush('user');

        return redirect()->route('home');
    }
}
