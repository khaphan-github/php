
@extends('client.layout.pages-layout')
@section('content')
 <div class="container rounded bg-white mt-5 mb-5">

<table class="table align-middle mb-0 bg-white">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Thumbnail URL</th>
            <th>Price at Purchase</th>
            <th>Number of Items</th>
            <th>Name</th>
            <th>Sell Price</th>
            <th>Original Price</th>
            <th>Discount Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->product_id }}</td>
            <td><img src="{{$order->thumbnail_url}}" alt=""> </td>
            <td>{{ $order->price_at_purchase }}</td>
            <td>{{ $order->number_of_items }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->sell_price }}</td>
            <td>{{ $order->original_price }}</td>
            <td>{{ $order->discount_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
 </div>
@endsection
