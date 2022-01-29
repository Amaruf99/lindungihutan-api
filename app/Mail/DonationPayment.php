<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonationPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $donorEmail;
    public $donorName;
    public $donationAmount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($email, $name, $amount)
    {
        $this->donorEmail = $email;
        $this->donorName = $name;
        $this->donationAmount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.donor')
            ->subject("Konfirmasi Pembayaran Donasi | Lindungi Hutan")
            ->view('emails.donor');
    }
}
