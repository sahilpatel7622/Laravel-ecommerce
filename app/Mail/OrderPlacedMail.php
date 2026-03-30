<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class OrderPlacedMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Order Placed Successfully')
            ->view('email-order');
    }

}
