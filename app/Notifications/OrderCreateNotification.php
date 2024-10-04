<?php

namespace App\Notifications;

use App\Models\order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreateNotification extends Notification
{
    use Queueable;

    protected $order;



    /**
     * Create a new notification instance.
     */
    public function __construct(order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return [ 'database','broadcast'];

        $Channels = ['database'];

        if ($notifiable->notification->reference['order_created']['sms'] ?? false) {
            $Channels[] = 'vonage';
        }
        if ($notifiable->notification->reference['order_created']['mail'] ?? false) {
            $Channels[] = 'mail';
        }
        if ($notifiable->notification->reference['order_created']['broadcast'] ?? false) {
            $Channels[] = 'broadcast';
        }

        return $Channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("order create # {$this->order->number}")
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/dashboard'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable){
        return [
            'body' => 'yes you can',
            'icon' => 'fas fa-file',
            'url' => url('/dashboard')

        ];

    }


    public function toBroadcast($notifiable){
        return  new BroadcastMessage([
            'body' => 'yes you can',
            'icon' => 'fas fa-file',
            'url' => url('/dashboard')

        ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
