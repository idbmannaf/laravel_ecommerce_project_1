@extends('layouts.fronend')
@section('content')
@auth
@if (Auth::user()->role == 1)
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="{{ url('') }}">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{ url('order') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <p>Full Name *</p>
                                <input type="text" name="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Your Address *</p>
                                <input type="text" name="address">
                                    @error('address')
                                         <p class="text-danger">{{ $message }}</p>
                                     @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="text" name="phone">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                               <div class="row">
                                <div class="col-6">
                                    <p>Country *</p>
                                    <select name="country" id="country_select">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <p>City *</p>
                                    <select name="city" id="city_select">
                                            {{-- Ajax request Working  --}}
                                    </select>
                                        @error('city')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                </div>
                               </div>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="text" name="zipcode">
                                 @error('zipcode')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>House/Flat</p>
                                <input type="text" name="house_flat">
                                @error('house_flat')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- <div class="col-12">
                                <input id="toggle1" type="checkbox">
                                <label for="toggle1">Pure CSS Accordion</label>
                                <div class="create-account">
                                    <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                    <span>Account password</span>
                                    <input type="password">
                                </div>
                            </div> --}}
                            {{-- <div class="col-12">
                                <input id="toggle2" type="checkbox">
                                <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                <div class="row" id="open2">
                                    <div class="col-12">
                                        <p>Country</p>
                                        <select id="s_country">
                                            <option value="1">Select a country</option>
                                            <option value="2">bangladesh</option>
                                            <option value="3">Algeria</option>
                                            <option value="4">Afghanistan</option>
                                            <option value="5">Ghana</option>
                                            <option value="6">Albania</option>
                                            <option value="7">Bahrain</option>
                                            <option value="8">Colombia</option>
                                            <option value="9">Dominican Republic</option>
                                        </select>
                                    </div>
                                    <div class=" col-12">
                                        <p>First Name</p>
                                        <input id="s_f_name" type="text" />
                                    </div>
                                    <div class=" col-12">
                                        <p>Last Name</p>
                                        <input id="s_l_name" type="text" />
                                    </div>
                                    <div class="col-12">
                                        <p>Company Name</p>
                                        <input id="s_c_name" type="text" />
                                    </div>
                                    <div class="col-12">
                                        <p>Address</p>
                                        <input type="text" placeholder="Street address" />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" placeholder="Apartment, suite, unit etc. (optional)" />
                                    </div>
                                    <div class="col-12">
                                        <p>Town / City </p>
                                        <input id="s_city" type="text" placeholder="Town / City" />
                                    </div>
                                    <div class="col-12">
                                        <p>State / County </p>
                                        <input id="s_county" type="text" />
                                    </div>
                                    <div class="col-12">
                                        <p>Postcode / Zip </p>
                                        <input id="s_zip" type="text" placeholder="Postcode / Zip" />
                                    </div>
                                    <div class="col-12">
                                        <p>Email Address </p>
                                        <input id="s_email" type="email" />
                                    </div>
                                    <div class="col-12">
                                        <p>Phone </p>
                                        <input id="s_phone" type="text" placeholder="Phone Number" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                @error('note')
                                 <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="order-area">
                                <h3>Your Order</h3>
                                <ul class="total-cost">
                                    <li>Subtotal <span class="pull-right"><strong>${{ session('subtotal') }}</strong></span></li>
                                    <li>Discount <span class="pull-right">{{ session('discount') }}%</span></li>
                                    <li>Shipping <span class="pull-right">Free</span></li>
                                    <li>Total<span class="pull-right">{{ session('subtotal') - session('discount') }}</span></li>
                                </ul>
                                <ul class="payment-method">
                                    <li>
                                        @error('payment')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </li>
                                    <li>
                                        <input id="delivery"  type="radio" name="payment" value="1">
                                        <label for="delivery">Cash on Delivery</label>
                                    </li>
                                    <li>
                                        <input id="bank" type="radio" name="payment" value="2">
                                        <label for="bank">Online Payment</label>
                                    </li>
                                </ul>
                                <button type="submit">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
    @else
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-center">You are not Customar <a class="text-success" href="{{ url('/') }}">Click Here</a> for Home</div>
            </div>
        </div>
    </div>
@endif

    @else
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger text-center">You are not logged please <a class="text-success" href="{{ url('login') }}">Click Here</a> for Login</div>
        </div>
    </div>
</div>
@endauth

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $('#country_select').select2();
        $('#city_select').select2();

        $("#country_select").change(function (e) {
            var county_id= $("#country_select").val();
            // alert(county_id);
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/getCityList",
                data: {county_id:county_id},
                success: function (response) {
                    // alert(response);
                    $("#city_select").html(response);
                }
            });

        });
    });
</script>
@endsection
