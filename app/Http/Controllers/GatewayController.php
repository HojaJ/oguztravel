<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function sms_get(Request $request)
    {
        if (isset($request->task) and $request->task === 'send') {
            $m = "Task Message";
            $reply = [];
            $messages = SMS::where('status', 0)->get();
            foreach ($messages as $message) {
                $reply[] = [
                    "to" => $message->to,
                    'message' => $message->content,
                    'uuid' => $message->uuid
                ];
            }
            // Send JSON response back to SMSsync
            $response = json_encode(
                ["payload" => [
                    "success" => true,
                    "task" => "send",
                    "secret" => "123456",
                    "messages" => array_values($reply)]
                ]);
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header("Content-type: application/json; charset=utf-8");
            echo $response;
        }

        if (isset($request->task) and $request->task == 'result') {
            $messages = SMS::select('uuid')->where('status', 0)->get()->pluck('uuid');;

            $response = json_encode([
                    "message_uuids" => $messages
                ]);
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header("Content-type: application/json; charset=utf-8");
            echo $response;
        }
    }

    public function sms_post(Request $request)
    {
        if(isset($request->task) AND $request->task === 'result'){
            if ($request->secret === 'oguztravel'){
                $message_results = file_get_contents('php://input');
                $this->write_message_to_file("message ".$message_results."\n\n");

            }
        }else if(isset($request->task) && $request->task === 'sent'){
            $data = file_get_contents('php://input');
            $queued_messages = file_get_contents('php://input');
            write_message_to_file($queued_messages."\n\n");
            send_message_uuids_waiting_for_a_delivery_report($queued_messages);
            $json_obj = json_decode($queued_messages);
            $response = json_encode(
                [
                    "message_uuids"=>$json_obj->queued_messages
                ]);
            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header("Content-type: application/json; charset=utf-8");
            echo $response;
        }else{
            $error = null;
            $success = false;
            $from = $request->from;
            $message = $request->message;
            $secret = $request->secret;
            $sent_timestamp = $request->sent_timestamp;
            $sent_to = $request->sent_to;
            $message_id = $request->message_id;
            $device_id = $request->device_id;
            if ($secret === 'oguztravel') {
                $success = true;
            } else {
                $error = "The secret value sent from the device does not match the one on the server";
            }
            $string = "From: ".$from."\n";
            $string .= "Message: ".$message."\n";
            $string .= "Timestamp: ".$sent_timestamp."\n";
            $string .= "Messages Id:" .$message_id."\n";
            $string .= "Sent to: ".$sent_to."\n";
            $string .= "Device ID: ".$device_id."\n\n\n";
            $this->write_message_to_file($string);

            $response = json_encode([
                "payload"=> [
                    "success"=>$success,
                    "error" => $error
                ]
            ]);

            header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
            header("Content-type: application/json; charset=utf-8");
            echo $response;

        }
        \Log::info('asd', $request->all());
        return response()->json([
            "medic-gateway" => true
        ]);
    }

    public function write_message_to_file($message)
    {
        $myFile = "test.txt";
        $fh = fopen($myFile, 'a') or die("can't open file");
        @fwrite($fh, $message);
        @fclose($fh);
    }
}
