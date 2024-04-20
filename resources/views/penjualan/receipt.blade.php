<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Receipt</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300;400&display=swap" rel="stylesheet">
    <style>
        @page {
            margin:0;
            border:0;
            size:80mm,100%;
        }
        body {
            font-size: 9pt;
            font-family: 'Inconsolata', monospace;
            text-align: justify;
        }
    </style>
</head>
<body>
{{-- @dd($dataOrder->invoice); --}}
<p>Invoice: {{ $dataOrder->invoice }}<br>
    Customer: {{ $dataOrder->customer->name ?? 'Customer Not Available' }}<br>
    Cashier: {{ Auth::user()->name ?? 'Cashier Not Available' }}<br>
    Tanggal: {{ $dataOrder->created_at->format('d M Y H:i') }}</p>

<table border="1">
    <thead>
        <tr>
            <td>Product</td>
            <td>Qty</td>
            <td>Price</td>
            <td>Amount</td>
        </tr>
    </thead>
    @foreach($dataOrderDetail as $dod)
        <tr>
            <td>{{ $dod->product->name }}</td>
            <td>{{ $dod->qty }}</td>
            <td>@money($dod->price)</td>
            <td>@money($dod->price * $dod->qty)</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3">Total:</td>
        <td>@money($dataOrder->total)</td>
    </tr>
</table>

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        window.print();
        setTimeout(myURL, 500000);
    });

    function myURL() {
        document.location.href = "{{ route('cetakReceipt') }}";
    }
</script>
</body>
</html>
