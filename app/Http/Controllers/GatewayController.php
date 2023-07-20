<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function sms_get(Request $request){
        if (isset($request->task) and $request->task === 'send') {
            $m = "test 10" ;
            $f = "+99364336223";
            $s = "true";
            $reply[0] = [
                "to" => $f,
                "message" => $m,
                "uuid" => "3ba368bd-c595-6084-cf38"
            ];
            $response = json_encode(
                ["payload" => [
                    "success" => $s,
                    "task" => "send",
                    "secret" => "123456",
                    "messages" => array_values($reply)]
                ]);
            $this->send_response($response);
        }

        if (isset($request->task) and $request->task == 'result') {
            $response = json_encode(
                [
                    "message_uuids" => ['1ba368bd-c467-4374-bf28']
                ]);
            $this->send_response($response);
        }
    }

    public function sms_post(Request $request)
    {
        if (isset($request->task) and $request->task === 'result') {
            if ($request->secret === '123456') {
                $message_results = file_get_contents('php://input');
                $this->write_message_to_file("message " . $message_results . "\n\n");
            }
        } else if (isset($request->task) && $request->task === 'sent') {
            $queued_messages = file_get_contents('php://input');
            $this->write_message_to_file($queued_messages . "\n\n");
            $this->send_message_uuids_waiting_for_a_delivery_report($queued_messages);
        } else {
            $error = NULL;
            $success = false;
            /**
             *  Get the phone number that sent the SMS.
             */
            if (isset($_POST['from'])) {
                $from = $_POST['from'];
            } else {
                $error = 'The from variable was not set';
            }
            /**
             * Get the SMS aka the message sent.
             */
            if (isset($_POST['message'])) {
                $message = $_POST['message'];
            } else {
                $error = 'The message variable was not set';
            }
            /**
             * Get the secret key set on SMSsync side
             * for matching on the server side.
             */
            if (isset($_POST['secret'])) {
                $secret = $_POST['secret'];
            }
            /**
             * Get the timestamp of the SMS
             */
            if (isset($_POST['sent_timestamp'])) {
                $sent_timestamp = $_POST['sent_timestamp'];
            }
            /**
             * Get the phone number of the device SMSsync is
             * installed on.
             */
            if (isset($_POST['sent_to'])) {
                $sent_to = $_POST['sent_to'];
            }
            /**
             * Get the unique message id
             */
            if (isset($_POST['message_id'])) {
                $message_id = $_POST['message_id'];
            }
            /**
             * Get device ID
             */
            if (isset($_POST['device_id'])) {
                $device_id = $_POST['device_id'];
            }
            /**
             * Now we have retrieved the data sent over by SMSsync
             * via HTTP. Next thing to do is to do something with
             * the data. Either echo it or write it to a file or even
             * store it in a database. This is entirely up to you.
             * After, return a JSON string back to SMSsync to know
             * if the web service received the message successfully or not.
             *
             * In this demo, we are just going to save the data
             * received into a text file.
             *
             */
            if (isset($from) AND (strlen($from) > 0) and (strlen($message) > 0) and
                (strlen($sent_timestamp) > 0) and (strlen($message_id) > 0)) {
                /* The screte key set here is 123456. Make sure you enter
                * that on SMSsync.
                */
                if (($secret == '123456')) {
                    $success = true;
                } else {
                    $error = "The secret value sent from the device does not match the one on the server";
                }

                $string = "From: " . $from . "\n";
                $string .= "Message: " . $message . "\n";
                $string .= "Timestamp: " . $sent_timestamp . "\n";
                $string .= "Messages Id:" . $message_id . "\n";
                $string .= "Sent to: " . $sent_to . "\n";
                $string .= "Device ID: " . $device_id . "\n\n\n";
                $this->write_message_to_file($string);
            }
            /**
             * Now send a JSON formatted string to SMSsync to
             * acknowledge that the web service received the message
             */
            $response = json_encode([
                "payload" => [
                    "success" => $success,
                    "error" => $error
                ]
            ]);
            $this->send_response($response);
        }
    }

    public function write_message_to_file($message)
    {
        $myFile = public_path("test.txt");
        $fh = fopen($myFile, 'a') or die("can't open file");
        @fwrite($fh, $message);
        @fclose($fh);
    }


    protected function send_response($response)
    {
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Content-type: application/json; charset=utf-8");
        echo $response;
    }

    protected function send_message_uuids_waiting_for_a_delivery_report($queued_messages)
    {
        $json_obj = json_decode($queued_messages);
        $response = json_encode(
            [
                "message_uuids" => $json_obj->queued_messages
            ]);
        $this->send_response($response);
    }
}
