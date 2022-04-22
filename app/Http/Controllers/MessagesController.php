<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    public function getMessages()
    {
        $this->url = config('urls.message');
        $messages_url = $this->url . 'messages?page_size=100';
        $messages_response = $this->get_curl($messages_url);
        $messages_data = json_decode($messages_response);

        // dd($messages_data);

        if (isset($messages_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.messages', ['messages' => $messages_data->results]);
        }
    }

    public function storeMessagesTemplate()
    {
        $this->url = config('urls.url');
        $templates_url = $this->url . 'templates';

        // dd(request()->all());

        // // request()->validate([
        // //     "contents" => "required",
        // //     "place_holders" => "required",
        // //     "template" => "required",
        // //     "template_status" => "required"
        // // ]);

        // // dd("here");

        $data = [
            "contents" => request()->contents,
            "place_holders" => request()->place_holders,
            "template" => request()->template,
            "template_status" => request()->template_status
        ];
        $templates_response = $this->to_curl($templates_url, $data);
        $templates_data = json_decode($templates_response);
        // dd($templates_data);

        if (empty($templates_data)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } elseif (isset($templates_data->code)) {
            return redirect()->route('signin');
        } elseif (!isset($templates_data->response_code)) {
            return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
        } else {
            if ($templates_data->response_code == 200) {
                // dd($templates_data->resource->customer_id);
                return redirect()->route('lead.application', $templates_data->resource->customer_id);
            } else if ($templates_data->errors) {
                return Redirect::back()->withErrors(['Customer already exists']);
            } else {
                return Redirect::back()->withErrors(['There is a technical error encountered, Please try again ']);
            }
        }
    }

    public function getMessagesTemplate($id = null)
    {
        $this->url = config('urls.message');
        $templates_url = $id ? $this->url . 'templates/' . $id : $this->url . 'templates?page_size=100';
        $templates_response = $this->get_curl($templates_url);
        $templates_data = json_decode($templates_response);

        // dd($templates_data, $templates_url);

        $templates_data = $id ? [$templates_data->resource] : $templates_data->results;

        // dd($templates_data);

        if (isset($templates_data->code)) {
            return redirect()->route('signin');
        } else {
            return view('content.message_template', ['templates' => $templates_data]);
        }
    }

    public function sendMessage()
    {
        $this->url = config('urls.message');
        $message_url = $this->url . 'messages';

        $contacts = implode(",", request()->msisdn);

        $data = [
            // "contents" => request()->contents,
            "message_status" => request()->message_status,
            "channel_id" => request()->channel_id,
            "message_language" => "ENG",
            "message_type" => "SMS",
            "recipient" => $contacts,
            "sender" => "Netcen",
            "placeholder_entries" => (object)[
                "now" =>  "1.00pm"
            ],
            "template_id" => request()->template_id
        ];

        // dd($data);

        $message_response = $this->to_curl($message_url, $data);
        $message_data = json_decode($message_response);
        // dd($message_data);

        if (empty($message_data)) {
            return response()->json(['response_code' => '500', 'message' => 'There is a technical error encountered, Please try again']);
        } else {
            if ($message_data->response_code == 200) {
                return response()->json($message_data);
            } else {
                dd($message_data);
            }
        }
    }
}
