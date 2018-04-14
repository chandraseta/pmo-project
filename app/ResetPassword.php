<?php
/**
 * Created by PhpStorm.
 * User: rionaldichandraseta
 * Date: 15/04/18
 * Time: 00:27
 */

namespace App;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject('[PMO] Reset Password Akun PMO')
            ->line('Anda menerima email ini karena sistem kami menerima permintaan untuk melakukan reset pada akun PMO anda. ')
            ->action('Reset Password', url('password/reset', $this->token))
            ->line('Jika anda tidak meminta reset password, anda tidak perlu menekan tombol di atas.')
            ->line('Terima kasih.');
    }
}