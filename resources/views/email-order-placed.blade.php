<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f4f7f6;
            padding: 30px 0;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }
        .email-header {
            background-color: #4F46E5;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .email-body {
            padding: 30px;
            color: #333333;
            line-height: 1.6;
            font-size: 16px;
        }
        .email-body h2 {
            font-size: 20px;
            color: #111827;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 10px;
        }
        .order-details {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            border: 1px solid #e5e7eb;
        }
        .order-details p {
            margin: 5px 0;
            font-size: 15px;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .order-items th {
            text-align: left;
            padding: 12px;
            background-color: #f3f4f6;
            color: #4b5563;
            font-size: 14px;
            font-weight: 600;
            border-bottom: 2px solid #e5e7eb;
        }
        .order-items td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #1f2937;
            font-size: 15px;
        }
        .order-total {
            text-align: right;
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            padding-top: 15px;
        }
        .shipping-info {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 25px;
            border: 1px solid #e5e7eb;
        }
        .email-footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }
        .btn-track {
            display: inline-block;
            background-color: #4F46E5;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-content">
            <!-- Header -->
            <div class="email-header">
                <h1>Order Confirmation</h1>
            </div>

            <!-- Body -->
            <div class="email-body">
                <p>Hi {{ $order->user->name ?? 'Customer' }},</p>
                <p>Thank you for shopping with us! Your order has been successfully placed. Here are the details of your recent purchase:</p>

                <!-- Order Details -->
                <div class="order-details">
                    <p><strong>Order ID:</strong> #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at ? $order->created_at->format('M d, Y h:i A') : now()->format('M d, Y') }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? 'N/A') }}</p>
                    <p><strong>Payment Status:</strong> <span style="color: {{ strtolower($order->payment_status) == 'completed' ? '#10b981' : '#f59e0b' }}; font-weight: bold;">{{ ucfirst($order->payment_status ?? 'Pending') }}</span></p>
                </div>

                <!-- Order Items -->
                <h2>Items Ordered</h2>
                <table class="order-items">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align: center;">Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->items && $order->items->count() > 0)
                            @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product ? $item->product->name : 'Unknown Product' }}</td>
                                <td style="text-align: center;">{{ $item->quantity }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" style="text-align: center; color: #6b7280; font-style: italic;">Items will be populated soon.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="order-total">
                    Total Amount: ₹{{ number_format($order->amount, 2) }}
                </div>
                
                <p style="margin-top: 25px;">If you have any questions about your order, please reply to this email or contact us.</p>
                <p>Best regards,<br><b>The E-Comm Team</b></p>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <p>&copy; {{ date('Y') }} The E-Comm. All Rights Reserved. Designed & Developed by E-Comm Team.</p>
            </div>
        </div>
    </div>
</body>
</html>
