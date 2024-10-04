<?php

namespace App\View\Components\dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Notifications\Notifiable;


class NotificationsMenu extends Component
{

    public $notifications;
    
    public $newCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $user = Auth::user();
        $this->notifications = $user->notifications()->take(10)->get(); 
        $this->newCount      = $user->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}