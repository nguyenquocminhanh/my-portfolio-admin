<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\VonageMessage;

class HireNotification extends Notification
{
    use Queueable;

    protected $hire;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($hire)
    {
        $this->hire = $hire; 
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
            ->subject('Minh Nguyen Portfolio Hire Message')
            ->greeting('Hello Minh!')
            ->line('You have received a hire request from '.$this->hire['name'])
            ->action('View message', url('/hire/view/'.$this->hire['id']))
            ->line('On '.date('M d, Y, g:i A', strtotime($this->hire['created_at'])).', you have received a hire request from '.$this->hire['name'].' ('.$this->hire['email'].') with message: '.$this->hire['message']);
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
        ->content('Hello Minh! On '.date('M d, Y, g:i A', strtotime($this->hire['created_at'])).', you received a hire request from '.$this->hire['name'].' with content: '.$this->hire['message'])
        ->unicode();
    }
}
