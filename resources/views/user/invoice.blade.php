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
        <div><strong>Order ID:</strong> ORD-2026-001</div>
        <div><strong>Order Date:</strong> 2025-10-24</div>
        <div><strong>Estimated Delivery:</strong> 2025-10-24</div>
        <div><strong>Payment Method:</strong> Cash</div>
    </div>
</div>

<div class="recipient">
    <strong>Recipient:</strong>
    <br>Customer: Pedro Mabaog
    <br>Contact Number: 0993340418
    <br>Address: Blk5 Lot1 Bagong Sibol St
    Casiguran, Ditinagyan Region III (Central Luzon), Aurora
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
    <tr>
        <td>1</td>
        <td>Milk</td>
        <td style="text-align: right;">x1</td>
        <td style="text-align: right;">PHP 100.00</td>
        <td style="text-align: right;">PHP 100.00</td>
    </tr>
    </tbody>
</table>

<div class="totals">
    <table>
        <tr><td>Subtotal:</td><td style="text-align:right;">PHP 100.00</td></tr>
        <tr><td>Shipping Fee:</td><td style="text-align:right;">PHP 50.00</td></tr>
        <tr><td><strong>Total:</strong></td><td style="text-align:right;"><strong>PHP 150.00</strong></td></tr>
    </table>
</div>


<div class="notes">
</div>


<div class="bottom-container">
    <div class="sender-details">
        <strong>Company Name: BNB Software Company</strong><br>
        Address: 25 Calachuchi St Navotas City Manila, Metro Manila<br>
        Phone: 09933404418<br>
        Email: bnb@gmail.com
    </div>

</div>
</body>
</html>
