<?php

namespace App\Jobs;

use App\Events\BlockPost;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $userIds;
    protected $message;
    protected $data;

    public function __construct($userIds, $message, $data)
    {
        $this->userIds = $userIds;
        $this->message = $message;
        $this->data = $data;
    }

    public function handle()
    {
        if ($this->userIds == null) {
            $users = User::all();
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->_id,
                    'message' => $this->message,
                    'data' => $this->data,
                    'read_at' => null,
                ]);
                broadcast(new BlockPost($user, $this->data))->toOthers();
            }
        }else{
            foreach ($this->userIds as $userId) {
                // Retrieve the user using the $userId
                $user = User::find($userId);
        
                Notification::create([
                    'user_id' => $user->_id,
                    'message' => $this->message,
                    'data' => $this->data,
                    'read_at' => null,
                ]);
        
                // Send the notification to the user with the provided data
                broadcast(new BlockPost($user, $this->data))->toOthers();
                // $user->notify(new YourNotification($this->notificationData));
            }
        }
       
       
        // broadcast(new BlockPost(User::find($this->userId), $this->data))->toOthers();
    }
}
