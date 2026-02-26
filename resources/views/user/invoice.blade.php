<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        @page {
            margin: 2cm 2cm 3cm 2cm;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background: white;
            font-size: 13px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1cm;
        }


        .invoice-meta {
            text-align: left;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .recipient {
            margin-bottom: 1cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1px solid #ddd;
            margin-bottom: 1.5cm;
        }

        th,
        td {
            border-top: 1px solid #ddd;
            padding: 6px 4px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f5f5f5;
            font-weight: 600;
        }

        .totals {
            width: 40%;
            float: right;
            margin-bottom: 0.5cm;
        }

        .totals td {
            padding: 4px 0;
        }

        .bottom-container {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5cm;
            margin-bottom: 1.5cm;
            page-break-inside: avoid;
        }

        .sender-details,
        .bank-info {
            width: 48%;
        }

        .bank-info {
            text-align: right;
        }

        .notes {
            clear: both;
            margin-bottom: 1.5cm;
            text-align: center;
        }
    </style>
</head>
<body class="">
<div class="header">
    <div class="invoice-meta">
        <div class="invoice-title">Invoice</div>
        <div><strong>Order ID:</strong> {{$order->order_number}}</div>
        <div><strong>Order Date:</strong> {{\Carbon\Carbon::parse($order->created_at)->format('F d, Y')}}</div>
        @php
        @endphp
        <div><strong>Estimated Delivery:</strong> {{\Carbon\Carbon::parse($order->created_at)
            ->addDays(3)
            ->format('F d, Y')}}
        </div>
        <div><strong>Payment Method:</strong> {{$order->payment_method}}</div>
    </div>
</div>
<div class="recipient">
    <strong>Recipient:</strong>
    <br>Customer: {{$deliveryAddress->first_name}} {{$deliveryAddress->last_name}}
    <br>Contact Number: {{$deliveryAddress->phone_number}}
    <br>Address:
    {{ $deliveryAddress->address }},
    {{ $deliveryAddress->barangay_name }},
    {{ $deliveryAddress->city_name }},
    {{ $deliveryAddress->region_name }}
</div>
<strong>Order Details</strong>
<table>
    <thead>
    <tr>
        <th style="width:5%">#</th>
        <th>Products</th>
        <th style="width:10%; text-align: right;">Qty</th>
        <th style="width:15%; text-align: right;">Product Price</th>
        <th style="width:15%; text-align: right;">Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->product_name}}</td>
            <td style="text-align: right;">x{{$item->quantity}}</td>
            <td style="text-align: right;">PHP {{number_format($item->unit_price, 2)}}</td>
            <td style="text-align: right;">PHP {{number_format($item->subtotal, 2)}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="totals">
        <table>
            <tr><td>Subtotal:</td><td style="text-align:right;">PHP {{number_format($subtotal, 2)}} </td></tr>
            <tr><td>Shipping Fee:</td><td style="text-align:right;">PHP 40.00</td></tr>
            <tr><td><strong>Total:</strong></td><td style="text-align:right;"><strong>PHP {{number_format($subtotal + 40, 2)}}</strong></td></tr>
        </table>
</div>

<div class="notes">
</div>


<div class="bottom-container">
    <div class="sender-details">
        <strong>Company Name: GHAGI MAN PRODUCTION</strong><br>
        Address: 109 Samson Road corner Caimito Road, Caloocan City, 1400 Metro Manila<br>
        Phone: 09933404418<br>
        Email: gmp@gmail.com
    </div>

</div>
@livewireScripts
</body>
</html>
