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
        return $this->subject('Order Confirmation - #'.str_pad($this->order->id, 6, '0', STR_PAD_LEFT))
            ->view('email-order-placed');
    }

}
