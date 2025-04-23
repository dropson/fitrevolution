<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class InviteClientNotification extends Notification
{
    use Queueable;

    public function __construct(private $client)
    {
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
    public function toMail(object $notifiable): MailMessage
    {

        $url = url('/join/'.$this->client->clientProfile->invitation_token);

        return (new MailMessage)
            ->subject('Invitation to Join Fit Revolution')
            ->line('You have been invited to join Fit Revolution as a client.')
            ->action('Join Now', $url)
            ->line('Thank you for joining us!');
    }
}
