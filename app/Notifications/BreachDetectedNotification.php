<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BreachDetectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */


    public $results;
    public function __construct($results)
    {
        $this->results = $results;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A potential data breach has been detected associated with your account.')
            ->action('Review Breaches', url('/path-to-review-page'))  // Adjust the URL to your needs
            ->line('Please take immediate action to secure your account.');
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
