<?php

namespace App\Http\Controllers;
use App\Models\ordermodel;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class PaymentController extends Controller
{
    // Method removed: checkout is now handled centrally in products controller

    public function success(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->payment_id);

        if ($payment->status == 'captured') {

            $order = ordermodel::where('order_id', $payment->order_id)->first();

            $order->payment_id = $request->payment_id;
            $order->status = 'Processing'; 
            $order->payment_status = 'Completed';
            $order->save();

            Mail::to(auth()->user()->email)->send(new OrderPlacedMail($order));

            return redirect('/myorders')->with('success', 'Payment successful!');
        }

        return redirect('/myorders')->with('error', 'Payment failed or was not captured.');
    }
}
