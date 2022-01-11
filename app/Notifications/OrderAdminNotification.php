<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Pusher\Pusher;

class OrderAdminNotification extends Notification
{
    use Queueable;

    public $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $orderData = array_merge(
            $this->data,
            ['id' => $this->id],
        );

        //realtime notify
        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('notifications-order', 'NotificationEvent', $orderData);

        return $orderData;
    }
}
