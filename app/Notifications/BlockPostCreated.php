<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use LaravelNotificationChannels\Mongodb\MongodbMessage;

class BlockPostCreated extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public string $blockPost;
    public  $users;
    public function __construct($users)
    {
        // $this->blockPost = $blockPost;
        $this->users = $users;
        Log::info("WORKING");
        Log::info("BLOCK" . $users);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable) {
        return [
            "user_id" => $this->users['_id'],
            "data" => $this->users['name'],
        ];
    }

    // public function toDatabase($notifiable)
    // {
    //     return [
    //         // 'user_id' => $this->users[0]['_id'],
    //         'message' => "Post Notification",
    //         // 'data' => $this->users[0]['name'],
    //         // 'read' => null,
    //     ];
    // }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "user_id" => $this->users['_id'],
            "data" => $this->users['name'],
        ];
    }

    public function toBroadcast($notifiable)
    {
        $notification = [
            "data" => [
                "email" => $this->users->email,
            ]
        ];
        return new BroadcastMessage([
            'notification' =>$notification,
        ]);
    }
}
