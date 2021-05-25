
<table class="table table-striped">

    <tr>
      <th>Order_id</th>
      <th>Total</th>
      <th>Discount</th>
      <th>Sub Total</th>
      <th>Payment By</th>
      <th>Order Date</th>
      <th>Action</th>
    </tr>
    @forelse ( $order_by_id as $user_order)
    <tr>
        <td>{{ $user_order->id}}</td>
        <td>{{ $user_order->total}}</td>
        <td>{{ $user_order->discount}}</td>
        <td>{{ $user_order->subtotal}}</td>
        @if ($user_order->payment_status == 1)
        <td>Cash On Delivery</td>
        @else
        <td>Online Payment</td>
        @endif
        <td>{{ $user_order->created_at}}</td>
        <td><a class="btn btn-info" href="{{ url('download/invoice') }}/{{ $user_order->id }}">Download Invoice</a></td>
      </tr>
    @empty

    @endforelse


  </table>

