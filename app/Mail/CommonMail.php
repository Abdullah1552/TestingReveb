<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $view;
    public $view_data=[];

    /**
     * Create a new message instance.
     *
     * @return void
     */

    //$details['subject'] is required
    public function __construct($view,$details,$view_data = [])
    {
        $this->details = $details;
        $this->view = $view;
        if(count($view_data)){
            $this->view_data = $view_data;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->details['subject'])
            ->view($this->view,$this->view_data);
    }
}
