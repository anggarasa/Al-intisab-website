<?php

namespace App\Livewire\Layout\TataUsaha\Notification;

use Livewire\Component;
use Livewire\Attributes\On;

class PopupNotificationTataUsaha extends Component
{
    // Properti untuk menyimpan pesan
    public $messages = [];

    #[On('notificationTataUsaha')]
    public function notificationTataUsaha($params)
    {
        $id = now()->timestamp;
        
        $this->messages[] = [
            'id' => $id,
            'type' => $params['type'] ?? 'info',
            'message' => $params['message'] ?? '',
            'title' => $params['title'] ?? ''
        ];
    }
    
    public function removeNotification($id)
    {
        $this->messages = collect($this->messages)
            ->filter(function($notification) use ($id) {
                return $notification['id'] !== $id;
            })->toArray();
    }
    
    public function render()
    {
        return view('livewire.layout.tata-usaha.notification.popup-notification-tata-usaha');
    }
}
