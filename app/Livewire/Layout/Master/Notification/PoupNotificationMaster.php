<?php

namespace App\Livewire\Layout\Master\Notification;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\On;

#[Layout('layouts.master-layout', ['title' => 'Notification'])]
class PoupNotificationMaster extends Component
{
    // Properti untuk menyimpan pesan
    public $messages = [];

    #[On('notificationMaster')]
    public function notificationMaster($params)
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
        return view('livewire.layout.master.notification.poup-notification-master');
    }
}
