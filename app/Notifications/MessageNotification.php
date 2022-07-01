<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class MessageNotification extends Notification
{
    use Queueable;

    /**
     * @var array $project
     */
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'vonage'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('minhnguyen-portfolio@example.com', 'Minh Nguyen Service')
            ->subject('Minh Nguyen Portfolio Contact Message')
            ->greeting('Hello Minh!')
            ->line('You have received a message from '.$this->message['name'])
            ->action('View message', url('/message/view/'.$this->message['id']))
            ->line('On '.date('M d, Y, g:i A', strtotime($this->message['created_at'])).', you have received a contact message from '.$this->message['name'].' ('.$this->message['email'].') with message: '.$this->message['message']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    public function toVonage($notifiable)
    {
    return (new VonageMessage)
        ->content('Hello Minh! On '.date('M d, Y, g:i A', strtotime($this->message['created_at'])).', you received a contact message from '.$this->message['name'].' with content: '.$this->message['message']);
    }
}
