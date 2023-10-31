<?php

namespace App\Broadcasting;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Notifications\Notification as LaravelNotification;
use Illuminate\Support\Facades\Log;

class MongoDBChannel
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function send($notifiable, LaravelNotification $notification)
    {
        // Convert the notification to an array
        Log::info("MOGO_CHANNEL");
        // $data = $notification->toDatabase($notifiable);
        Log::info("notifiable => ".$notifiable);

        // Store the notification in MongoDB
        Notification::create([
            'user_id' => $notifiable->_id,
            // 'data' => $data,
            'read' => false,
        ]);
    }


    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user)
    {
        //
    }
}
