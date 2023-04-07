<?php

namespace App\Mail;

use App\Models\WhereHouse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SaleOrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $SID;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($SID)
    {
        $this->SID=$SID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $SID=$this->SID;
        return $this->subject('Mail from Revebe')
            ->view('Mails.sale_order',compact('SID'));
    }
}
