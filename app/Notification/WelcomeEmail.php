<?php
/**
 * Created by PhpStorm.
 * User: rionaldichandraseta
 * Date: 15/04/18
 * Time: 19:12
 */

namespace App\Notification;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
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
            ->subject('[PMO] Selamat Datang')
            ->line('Anda telah terdaftar pada website PMO. Pertama-tama, anda perlu menentukan password anda. Klik tombol di bawah untuk memulai.')
            ->action('Set Password', url('password/reset', $this->token))
            ->line('Catatan: Anda harus menentukan password sebelum dapat melakukan login pada website PMO.')
            ->line('Terima kasih.');
    }
}