<?php

namespace Modules\Ledger\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailNotification extends Notification
{
    use Queueable;

    public $subject;
    public $email_message;
    public $file_path;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subject, $email_message, $file_path="", $only_email_pdf="")
    {
        $this->subject = $subject;
        $this->email_message = $email_message;
        $this->file_path = $file_path;
        $this->only_email_pdf = $only_email_pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data['email_message'] = $this->email_message;
           
        return (new MailMessage)
        ->subject($this->subject)
        ->greeting('Hello')        
        ->line($this->email_message);
        //->markdown('Ledger::mail.notification', $data);  
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
}
