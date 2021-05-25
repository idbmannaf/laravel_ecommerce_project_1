@extends('layouts.fronend')
@section('content')
 <!-- .breadcumb-area start -->
 <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ url('cart/update/qty') }}" method="POST">

                                @csrf

                                    @php
                                        $sub_total= 0;
                                        $cart_status= true;
                                    @endphp
                                    @forelse ($cart_items as $cart_item)
                                    <tr>
                                        <td class="images"><img src="{{ asset('uploads/product_photos') }}/{{ App\Models\Product::find($cart_item->product_id)->product_photo }}" alt=""></td>
                                        <td class="product">
                                            <a target="_blank" href="{{ url('product/details') }}/{{ $cart_item->product_id }}">{{ App\Models\Product::find($cart_item->product_id)->product_name }}</a>
                                        @if ($cart_item->quantity > App\Models\Product::find($cart_item->product_id)->product_quantity )
                                        <div class="badge badge-danger ">Out Of Stock</div>
                                        <div class="badge badge-success ">Avoilable: {{ App\Models\Product::find($cart_item->product_id)->product_quantity }}</div>
                                            @php
                                                $cart_status = false;
                                            @endphp
                                        @endif
                                        </td>
                                        <td class="ptice">${{ App\Models\Product::find($cart_item->product_id)->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" name="quantity[{{ $cart_item->id }}]" value="{{ $cart_item->quantity }}" id="update_quantitiy" />
                                        </td>
                                        <td class="total">${{ $cart_item->quantity * App\Models\Product::find($cart_item->product_id)->product_price }}</td>
                                        <td class="remove"> <a href="{{ url('cart/delete') }}/{{ $cart_item->id }}"><i class="fa fa-times"></i></a></td>
                                    </tr>
                                    @php
                                        $sub_total += $cart_item->quantity * App\Models\Product::find($cart_item->product_id)->product_price;
                                    @endphp
                                    @empty
                                        <tr>
                                            <td colspan="50" class="text-danger">Product not found in Cart</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                            <div class="row mt-60">
                                <div class="col-xl-4 col-lg-5 col-md-6 ">
                                    <div class="cartcupon-wrap">
                                        <ul class="d-flex">
                                            <li>
                                                <button id="update_btn" type="submit">Update Cart</button>
                        </form>
                                    </li>
                                    <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                </ul>
                                <h3>Cupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" placeholder="Cupon Code" id="coupon_code" value="{{ $coupon_code }}">
                                    <button id="coupon">Apply Coupon</button>
                                    @if ($coupun_msg)
                                        <div class="alert alert-danter text-danger">{{ $coupun_msg }}</div>
                                        @else

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal </span>${{ $sub_total }}</li>
                                    <li><span class="pull-left"> Discount ({{ $discount }}%)</span> -${{ $descount= ($discount / 100)*$sub_total }}</li>
                                    <li><span class="pull-left"> Total </span> ${{ $total= $sub_total-$descount}}</li>
                                    @php
                                        session(['subtotal'=> $sub_total]);
                                        session(['discount'=> $descount]);
                                    @endphp
                                </ul>
                                @if ($cart_status)
                                <a href="{{ url('checkout') }}">Proceed to Checkout</a>
                                @else
                                <b class="text-danger">Check Stockout Product</b>
                                @endif
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection
@section('script')
<script>
    $(document).ready(function(){
            $('#coupon').click(function(){
                var coupon_code= $('#coupon_code').val();
                var current_url = '{{ url('cart') }}/'+coupon_code;
                // alert(current_url);
                window.location=current_url;
            });
            $('.qtybutton').click(function(){
                $('#update_btn').css('background-color','green');
                $('#update_btn').text('Update Now');
            });
            $('.qtybutton').click(function(){
                $('#update_btn').css('background-color','green');
                $('#update_btn').text('Update Now');
            });
            $('#update_quantitiy').change(function(){
                $('#update_btn').css('background-color','green');
                $('#update_btn').text('Update Now');
            });
         });
</script>
@endsection
