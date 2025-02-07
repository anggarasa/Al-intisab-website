<?php

namespace App\Livewire\Layout\Kurikulum\Notification;

use Livewire\Component;
use Livewire\Attributes\On;

class PopupNotificationKurikulum extends Component
{

    // Properti untuk menyimpan pesan
    public $messages = [];

    #[On('notificationKurikulum')]
    public function notificationKurikulum($params)
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
        return view('livewire.layout.kurikulum.notification.popup-notification-kurikulum');
    }
}
