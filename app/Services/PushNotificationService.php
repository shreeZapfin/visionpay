<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 30-Jul-21
 * Time: 3:32 AM
 */

namespace App\Services;


use App\Models\FcmToken;
use App\Models\NotificationLog;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PushNotificationService
{

    public function sendFirebasePushNotification($title, $body, array $userId, array $entityData = [])
    {

        $this->storeNotificationLog($title, $body, $userId, $entityData);

        $url = 'https://fcm.googleapis.com/fcm/send';

        $serverKey = env('FIREBASE_SERVER_KEY');

        $fcmTokens = FcmToken::whereIn('user_id', $userId)->pluck('fcm_token');

        if ($fcmTokens->isEmpty())
            return;


//        $chunks = array_chunk($fcmTokens->toArray(), 750);

//        dd($chunks);

        $data = [
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            'registration_ids' => $fcmTokens
        ];

        Log::info('Request to push notify ' . json_encode($data));

        $headers = [
            'Authorization' => 'key=' . $serverKey,
        ];

        $response = Http::withHeaders($headers)
            ->withOptions([
                'verify' => false,
            ])
            ->post($url, $data);
        Log::info('Fire base notification response ' . $response->body());
        if ($response->successful())
            return true;
        return false;


    }


    public function storeNotificationLog($title, $body, $userId, $entityData)
    {

        if (is_array($userId)) {
            $insertData = [];
            foreach ($userId as $key => $id) {
                $insertData[$key] = [
                    'title' => $title,
                    'body' => $body,
                    'user_id' => $id,
                    'entity' => isset($entityData['entity']) ? $entityData['entity'] : null,
                    'entity_event' => isset($entityData['entity_event']) ? $entityData['entity_event'] : null,
                    'entity_unique_id' => isset($entityData['entity_unique_id']) ? $entityData['entity_unique_id'] : null,
                ];
            }

            NotificationLog::insert($insertData);

        } else {

            NotificationLog::create([
                'title' => $title,
                'body' => $body,
                'user_id' => $userId,
                'entity' => isset($entityData['entity']) ? $entityData['entity'] : null,
                'entity_event' => isset($entityData['entity_event']) ? $entityData['entity_event'] : null,
                'entity_unique_id' => isset($entityData['entity_unique_id']) ? $entityData['entity_unique_id'] : null,
            ]);
        }

    }


}