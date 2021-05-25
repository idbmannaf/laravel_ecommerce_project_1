@extends('layouts.fronend')
@section('content')
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Category</h2>
                    <ul>
                        <li><a href="{{ url('shop') }}">Shop</a></li>
                        <li><span>Category</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Category  Name: {{ $cat_id }}</h2>
                    <img src="{{ asset('assets/images/section-title.png') }}" alt="">
                </div>
            </div>
        </div>

           <ul class="row">
               @forelse ($catwaise_products as $product)
               @include('part.product_list',['product'=>$product])
               @empty
                   <div class="col-md-12">
                       <h4 class="text-center text-danger">Product Not Found</h4>
                   </div>
               @endforelse
           </ul>


    </div>
</div>
<!-- product-area end -->
@endsection
