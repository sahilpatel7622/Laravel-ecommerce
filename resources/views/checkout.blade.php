<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; font-family: sans-serif;">
    <h3>Redirecting to Secure Payment Gateway...</h3>
    <p>Please do not refresh or close this page.</p>
    <button id="pay-btn" style="display: none;">Pay Now</button>
</div>

<script>
var options = {
    "key": "{{ env('RAZORPAY_KEY') }}",
    "amount": "{{ $order->amount * 100 }}",
    "currency": "INR",
    "name": "My E-Commerce",
    "order_id": "{{ $order->order_id }}",

    "handler": function (response){
        window.location.href = "/payment-success?payment_id=" + response.razorpay_payment_id;
    }
};

var rzp = new Razorpay(options);

window.onload = function(e){
    document.getElementById('pay-btn').click();
}

document.getElementById('pay-btn').onclick = function(e){
    rzp.open();
    e.preventDefault();
}
</script>