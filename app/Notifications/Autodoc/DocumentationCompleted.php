<?php

namespace App\Notifications\Autodoc;

use App\Models\AutodocLead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class DocumentationCompleted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public AutodocLead $lead,
    ) {
        //
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
        return (new MailMessage)
                    ->line('Your documentation is ready!')
                    ->line('Please, access the following link to download the documentation.')
                    ->action('Download my docs', URL::signedRoute('autodoc.success', ['autodocLead' => $this->lead]))
                    ->line('If you have any issue with the documentation or the purchase, feel free to contact us at hi@automaticdocs.app. It is possible that some files were not documented as planned due to issues with OpenAI\'s API, but you can get in touch with us to solve it.')
                    ->line('Thank you for using our application!');
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
