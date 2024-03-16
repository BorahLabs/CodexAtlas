<?php

namespace App\Notifications\Autodoc;

use App\Models\AutodocLead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class PurchaseCompleted extends Notification
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
            ->line('We have received your payment and are now processing your order.')
            ->line('You will receive an email with the documentation once it is ready, but you can follow the status in real time in the following link.')
            ->action('See status', URL::signedRoute('autodoc.success', ['autodocLead' => $this->lead]))
            ->line('If you have any issue with the documentation or the purchase, feel free to contact us at hi@automaticdocs.app')
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
