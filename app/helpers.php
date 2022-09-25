<?php

use App\DeviceToken;
use App\OrderHasStatus;
use App\Status;
use Illuminate\Support\Facades\Log;

if (!function_exists('error_msg_serialize')) {
    /**
     *
     * Error Message Serializing
     *
     */
    function error_msg_serialize($errorList, $innerArray = false)
    {
        $errorData = $errorList;
        $errorData = $errorData->toArray();
        $errors    = [];
        $i         = 0;
        foreach ($errorData as $key => $value) {
            $errors[$i] = $value[0];
            $i++;
        }
        if ($innerArray) {
            return array_values(array_unique($errors));
        }
        return $errors;
    }
}

if (!function_exists('verification_code')) {
    /**
     *
     * Create Confirmation Code for Email Verification
     *
     */
    function verification_code($length = 10, $data = null)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $data . $key;
    }
}

if (!function_exists('sendVerification_code')) {
    /**
     *
     * Create Confirmation Code for Email Verification
     *
     */
    function sendVerification_code($length = 10, $data = null)
    {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $data . $key;
    }
}


/**
 * get notification data
 */

if (!function_exists('getNotiData')) {
    function getNotiData($status, $order, $is_driver = false)
    {
        if ($status == "just_created") {
            //Created
            $greeting = __('Request From Client');
            $line = __('You Have Got a request from our client. Please check details. ');
        }
        if ($status == "accepted_by_vendor") {
            //accpeted
            $greeting = __('Booking Request Approved');
            $line = __('Our service provider accept you charger booking request. You are good to go now.');
        }
        if ($status == "cancelled_by_customer") {
            //customer cancel request
            $greeting = __('Booking Request Cancelled');
            $line = __('Customer cancel charger request.');
        }
        if ($status == "cancelled_by_vendor") {
            //customer cancel request
            $greeting = __('Booking Request Cancelled');
            $line = __('Charger reuqets is cancelled by service provider.');
        }

        return ['title' => $greeting, 'body' => $line];
    }
}

/**
 * send notification
 */

if (!function_exists('sendNotification')) {
    function sendNotification($status, $order, $is_vendor = false)
    {
        $message = getNotiData($status, $order, $is_vendor);
        Log::info("message in helper--" . json_encode($message));

        $orderId = $order->id;
        $id = ($is_vendor) ?  $order->provider_id : $order->customer_id;
        $device_tokens = DeviceToken::where('user_apps_id', $id)->pluck('device_token');
        $SERVER_API_KEY = env('FCM_KEY');
        $type = "basic";
        $data = (object)[
            'registration_ids' => $device_tokens,
            'data' => (object)[
                'body' => $message['body'],
                'title' => $message['title'],
                'type' => $type,
                'id' => $id,
                'status' => $status,
                'role' => ($is_vendor) ? 'vendor' : 'customer',
                'order_id' => $orderId,
                'message' => $message['body'],
            ],
            'notification' => (object)[
                'body' => $message['body'],
                'title' => $message['title'],
                'type' => $type,
                'id' => $id,
                'status' => $status,
                'role' => ($is_vendor) ? 'vendor' : 'customer',
                'order_id' => $orderId,
                'message' => $message['body'],
                'icon' => 'new',
                'sound' => 'default',
            ]
        ];
        Log::info("message in helper data total --" . json_encode($data));
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        Log::info("notification response.-" . json_encode($response));
        return $response;
    }
}

/**
 * send Chat notification
 */

if (!function_exists('sendChatNotification')) {
    function sendChatNotification($user, $message)
    {

        $id = $user->id;
        $device_tokens = DeviceToken::where('user_apps_id', $id)->pluck('device_token');
        $SERVER_API_KEY = env('FCM_KEY');
        $type = "basic";
        $data = (object)[
            'registration_ids' => $device_tokens,
            'data' => (object)[
                'body' => $user->user_name . ' Send you a message',
                'title' => 'Chat Notification',
                'type' => $type,
                'sender_id' => $message->sender_id,
                'reciever_id' => $message->receiver_id,
                'message_id' => $message->id,
                'message' => $user->user_name . ' Send you a message',
            ],
            'notification' => (object)[
                'body' => $user->user_name . ' Send you a message',
                'title' => 'Chat Notification',
                'type' => $type,
                'id' => $id,
                'sender_id' => $message->sender_id,
                'reciever_id' => $message->receiver_id,
                'message_id' => $message->id,
                'message' => $user->user_name . ' Send you a message',
                'icon' => 'new',
                'sound' => 'default',
            ]
        ];
        Log::info("message in helper data total --" . json_encode($data));
        $dataString = json_encode($data);
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        curl_close($ch);

        Log::info("notification response.-" . json_encode($response));
        return $response;
    }
}
