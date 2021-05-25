
@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a  href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <a href="{{ url('category') }}">Category</a>  &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Edit Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="top mb-5">
			<div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        @if (session('msg'))
                            <div class="alert alert-success">{{ session('msg') }}  <a class="" href="{{ url('category') }}"> View Category</a></div>
                        @endif
                <form method="POST" action="{{ url('category/update') }}">
                    @csrf
                    @foreach ($singleCat as $cat)
                    <input type="hidden" name="hiddenid" value="{{ $cat->id }}">
                    <div class="form-group">
                        <label for="catName">Category Name</label>
                        <input type="text" name="uCatName" id="catName" value="{{ $cat->category_name }}"  class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Update" value="Add Category" class="form-control btn btn-info">
                    </div>
                @endforeach
                </form>
                    </div>
                </div>
			</div>
		</div>

	</div>
 </div>
@endsection

