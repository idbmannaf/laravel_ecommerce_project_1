@extends('layouts.fronend')
@section('content')
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><span>Shop</span></li>
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
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All product</a>
                        </li>
                            @foreach ($all_category as $category)
                                <li class="mb-2">
                                    <a data-toggle="tab" href="#category_{{ $category->id }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach

                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @foreach ($all_products as $product)
                     @include('part.product_list',['product'=>$product])
                    @endforeach
                </ul>
            </div>
            @foreach ($all_category as $category)
            <div class="tab-pane" id="category_{{ $category->id }}">
                <ul class="row">
                    @forelse (App\Models\Product::where('cat_id',$category->id)->get() as $category_to_product)
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                        <div class="product-wrap">
                            <div class="product-img">
                                <span>Sale</span>
                                <img src="{{ asset('uploads/product_photos').'/'.$category_to_product->product_photo }}" alt="">
                                <div class="product-icon flex-style">
                                    <ul>
                                        <li><a data-toggle="modal" data-target="#catwaize{{ $category_to_product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                        @auth
                                        <li><a href="{{ url('wishlist/add') }}/{{ $category_to_product->id }}"><i class="fa fa-heart"></i></a></li>
                                        @endauth
                                        <li><a href="{{ url('product/details/') }}/{{ $category_to_product->id }}"><i class="fa fa-shopping-bag"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-content">
                                <h3><a href="{{ url('product/details').'/'.$category_to_product->id }}">{{ $category_to_product->product_name }}</a></h3>
                                <p class="pull-left">${{ $category_to_product->product_price }}

                                </p>
                                <ul class="pull-right d-flex">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-half-o"></i></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!-- Modal area start -->
 <div class="modal fade" id="catwaize{{ $category_to_product->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body d-flex">
                <div class="product-single-img w-50">
                    <img src="{{ asset('uploads/product_photos')."/".$category_to_product->product_photo }}" alt="">
                </div>
                <div class="product-single-content w-50">
                    <h3>{{ $category_to_product->product_name }}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{ $category_to_product->product_price }}</span>
                        <ul class="rating pull-right">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li>(05 Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{ Str::substr($category_to_product->product_details, 0, 200) }}</p>
                    @if ($category_to_product->product_quantity == 0)
                    <div class="alert alert-danger ">This Product is Out of Stock</div>

                    @else
                    <form action="{{ url('add/cart') }}" method="post">
                        <input type="hidden" name="product_id" value="{{ $category_to_product->id}}">
                        @csrf
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input type="text" name="quantity" value="1" />
                            </li>
                            <li><button class="btn btn-danger rounded-0" type="submit">Add to Cart</button></li>
                     </ul>
                    </form>
                    @endif
                    <ul class="cetagory">
                        <li>Categories:</li>
                        <li><a href="#">Honey,</a></li>
                        <li><a href="#">Olive Oil</a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal area start -->

                    @empty
                        <h3 class="col-md-12 m-auto text-danger text-center">Product Not Found</h3>
                    @endforelse
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- product-area end -->
@endsection
