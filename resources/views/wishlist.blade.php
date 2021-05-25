@extends('layouts.fronend')
@section('content')
 <!-- .breadcumb-area start -->
 <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Wishlist</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Wishlist</span></li>
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
                                <th class="ptice">Quantity</th>
                                <th class="stock">Stock Stutus </th>
                                <th class="addcart">Add to Cart</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wishlists as $wish)
                            <tr>
                                <td class="images"><img src="{{ asset('uploads\product_photos') }}/{{ $wish->product_image }}" alt=""></td>
                                <td class="product"><a href="{{ url('product/details') }}/{{  $wish->product_id }}">{{  $wish->product_name }}</a></td>
                                <td class="ptice">${{  $wish->product_price }}</td>
                                <td class="ptice">{{  $wish->product_quantity }}</td>
                                @if ($wish->product_quantity !=0)
                                    <td class="stock">In Stock</td>
                                    <form action="{{ url('add/cart') }}" method="post">
                                        <input type="hidden" name="product_id" value="{{ $wish->product_id}}">
                                        <input type="hidden" name="quantity" value="{{ $wish->product_quantity}}" />
                                        @csrf
                                    <td class="addcart "><button type="submit" class="btn btn-danger">Add to Cart</button></td>
                                    </form>
                                @else
                                    <td class="stock"><span>Out Stock</span></td>
                                    <td class="addcart">This Product out of Stock</td>
                                @endif
                                <td class="remove"><a href="{{ url('wishlist/delete') }}/{{ $wish->product_id }}"><i class="fa fa-times"></i></a></td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="50" class="text-center text-danger">WishList Empty check Cart</td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection
