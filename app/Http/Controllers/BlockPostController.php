<?php

namespace App\Http\Controllers;

use App\Events\BlockPost;
use App\Events\BlockPostForAll;
use App\Events\SendMessages;
use App\Jobs\SendNotification;
use App\Models\BlogPost;
use App\Models\Notification;
use App\Notifications\BlockPostCreated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Notification;

class BlockPostController extends Controller
{
    public function createBlockPost(Request $request)
    {
        try {
            $selectedUserIds = $request->input('user_id');
            $blockPost = ["data" => "BlogPost created"];

            /**
             * @method-2 
             */
            $message = "Post Notification";
            $data = $blockPost;
            SendNotification::dispatch($selectedUserIds, $message,$data);
            // dispatch(new SendNotification($selectedUserIds, $message, $data));
            
            return "Success";

            /**
             * @method-1 
             */
            // if (empty($selectedUserIds)) {
            //     Notification::create([
            //     'user_id' => 'All users',
            //     'message' => "Post Notification",
            //     'data' => $blockPost,
            //     'read_at' => null,
            // ]);
            //     broadcast(new BlockPostForAll($blockPost))->toOthers();
            //     return "Success to all";
            // } else {
            //     $users = User::whereIn('_id', $selectedUserIds)->get();
            //     foreach ($users as $user) {
            //         Log::info($user->_id);
            //         Notification::create([
            //             'user_id' => $user->_id,
            //             'message' => "Post Notification",
            //             'data' => $blockPost,
            //             'read_at' => null,
            //         ]);
            //         broadcast(new BlockPost($user, $blockPost))->toOthers();
            //     }

            //     return "Success";
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

  // broadcast(new BlockPost($users,$blockPost))->toOthers();

            // $user->notify(new BlockPostCreated($users));
            // Notification::send($user, new BlockPostCreated($blockPost));
// return "Sucess";


// $user->notify(new InvoicePaid($invoice)) ;
            // $users->notify(new BlockPostCreated($users,$blockPost));
            // Notification::send($users, new BlockPostCreated($users,$blockPost));