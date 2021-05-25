
@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a href="{{ url('home') }}">Dashboard</a>  &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="top mb-5">
			<div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header">Add Coupon</div>
                    <div class="card-body">

                        @if (session('coupon_msg'))
                        <div class="alert alert-success">{{ session('coupon_msg') }}</div>
                        @endif
                        @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                <form method="POST" action="{{ route('insertCoupon') }}">
                    @csrf
                    <div class="form-group">
                        <label for="coupon_name">Coupon Name</label>
                        <input type="text" name="coupon_name" id="coupon_name"  class="form-control">
                        @error('coupon_name')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_discount">Coupon Discount</label>
                        <input type="text" name="coupon_discount" id="coupon_discount"  class="form-control">
                        @error('coupon_discount')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="coupon_validity_till">Coupon Validity</label>
                        <input type="date" name="coupon_validity_till" id="coupon_validity_till"  class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Coupon" class="form-control btn btn-info">
                    </div>
                </form>
                    </div>
                </div>
			</div>
		</div>
		<div class="bottom col-md-10 m-auto">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between"><h5>Copun List</h5> </div>
                <div class="card-body">
                    @if (session('coupon_del_msg'))
                        <div class="alert alert-danger"> {{ session('coupon_del_msg') }}</div>
                    @endif
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Coupon Name</th>
                                <th>Discount</th>
                                <th>Start Date</th>
                                <th>Expire Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    @foreach ($coupon as $key=>  $row)

                        <tr>
                            <td> {{ $coupon->firstItem() + $key}}</td>
                            <td> {{ $row->coupon_name }}</td>
                            <td> {{ $row->coupon_discount }}</td>
                            <td> {{ $row->created_at }}</td>
                            <td> {{ \Carbon\Carbon::parse($row->coupon_validity_till)->diffforHumans() }}</td>
                            <td><a class="btn btn-danger" href="{{ url('coupon/delete') }}/{{ $row->id }}" onclick="return confirm('You want to Deleted This Coupon Code');">Delete</a></td>

                        </tr>

                    @endforeach
                    <tr>
                        <td class="text-center" colspan="50">{{ $coupon->links() }}</td>
                    </tr>
                </tbody>
                </table>

                </div>
            </div>
		</div>
	</div>
 </div>
@endsection
