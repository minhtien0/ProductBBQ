<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TableStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function broadcastOn()
    {
        // Public channel: bạn có thể đặt lại cho đúng usecase của bạn
        return new Channel('tables');
    }

    public function broadcastWith()
    {
        // Dữ liệu truyền ra FE
        return [
            'id' => $this->table->id,
            'status' => $this->table->status,
            // Thêm các trường khác nếu cần
        ];
    }
}

