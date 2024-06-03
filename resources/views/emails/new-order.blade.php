<html>
<head>
    <title>New Order</title>
</head>
<body>
    <h1>New Order from {{ $order->name }} {{ $order->surname }}</h1>
    <p>Email: {{ $customerData['email'] }}</p>
    <p>Phone Number: {{ $order->phone_number }}</p>
    <p>Address: {{ $order->address }}</p>
    <p>Total: {{ $order->total }} &euro;</p>

    <h2>Order Details</h2>
    <ul>
        @foreach ($order->plates as $plate)
            <li>{{ $plate->pivot->quantity }}x {{ $plate->name }} ({{ $plate->pivot->quantity * $plate->price }} &euro;)</li>
        @endforeach
    </ul>
</body>
</html>