<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use App\Models\Notification;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

use function Livewire\Volt\layout;

class Notifications extends Component
{
    public $userNotification;


    protected $listerners =[
   'commentCreated' => '$commmentGenerated'
    ];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->userNotification = Notification::where('user_id', auth()->id())
                                           ->where('is_read', false)
                                           ->latest()
                                           ->get();

                 $this->dispatch('createdNotication');                        
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        if ($notification && $notification->user == auth()->id()) {
            $notification->update(['is_read' => true]);
        }
    }

    public function render()
    {
        $this->loadNotifications();

    
        return view('livewire.notifications', [
            'userNotification' => $this->userNotification
        ])->layout('layouts.app');
    }
    
    public function sendEmailNotification($notification)
    {
        $user = $notification->user;
        Mail::to($user->email)->send(new EmailNotification($notification));
    }

  

}
