<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostChangeActive implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $content;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('notification.' . $this->post->user_id);
    }

    public function broadcastWith()
    {
        if($this->post->is_active == 1){
            $this->content = "Bài viết " . Str::limit($this->post->title, 10) . " đã được kích hoạt"; 
        }
        else{
            $this->content = "Bài viết " . Str::limit($this->post->title, 10) . " đã bị ẩn";
        }
        $notification = Notification::create([
            "content" => $this->content,
            "user_id" => $this->post->user_id
        ]);
        return [
            "status" => $this->post->is_active,
            "notification" => $notification
        ];
    }


}
