<li class="col-xl-3 col-lg-4 col-sm-6 col-12">
    <div class="product-wrap">
        <div class="product-img">
            <span>Sale</span>
            <img src="{{ asset('uploads/product_photos')."/".$product->product_photo }}" alt="">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#example{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    @auth
                    <li><a href="{{ url('wishlist/add') }}/{{ $product->id }}"><i class="fa fa-heart"></i></a></li>
                    @endauth
                    <li><a href="{{ url('product/details') }}/{{ $product->id }}"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ url('product/details').'/'.$product->id }}">{{ $product->product_name }}</a></h3>
            <p class="pull-left">${{ $product->product_price }}

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
 <div class="modal fade" id="example{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body d-flex">
                <div class="product-single-img w-50">
                    <img src="{{ asset('uploads/product_photos')."/".$product->product_photo }}" alt="">
                </div>
                <div class="product-single-content w-50">
                    <h3>{{ $product->product_name }}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">${{ $product->product_price }}</span>
                        <ul class="rating pull-right">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li>(05 Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{ $product->product_details }}</p>
                    <ul class="input-style">
                        <li class="quantity cart-plus-minus">
                            <input type="text" value="1" />

                        </li>
                        <li><a style="height: auto !important" class="btn btn-danger btn-sm"href="{{ url('product/details/') }}/{{ $product->id }}">Add to Cart</a></li>
                    </ul>
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
