<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HireMessage extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    // customize receipient for mail
    public function routeNotificationForMail($notification)
    {
        // Return email address and name...
        return [env('MAIL_TO_ADDRESS') => 'Minh Nguyen'];
    }

    // customize receipient for sms
    public function routeNotificationForVonage($notification)
    {
        return env('VONAGE_SMS_TO');
    }
}
