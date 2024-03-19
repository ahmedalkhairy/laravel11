<?php

namespace App\Notifications;

use App\Models\Server;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InstanceExitedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $response;
    private $server;

    public function __construct($response,Server $server)
    {
        $this->response = $response;
        $this->server = $server;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // Use both email and database channels
    }

    public function toMail($notifiable)
    {
        $url = route('servers.show', $this->server['id']); // Replace with your route generation logic

        return (new MailMessage)
            ->level('warning')
            ->subject('Instance Exited Notification')
            ->line('The instance with ID ' . $this->server['id'] . ' has exited.')
            ->action('View Instance', $url);
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'The instance with ID ' . $this->server['id'] . ' has exited.',
            'data' => $this->response['actual_status'],
        ];
    }
}
