@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a  href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <a  href="{{ url('subcategory') }}">Sub Category</a> &nbsp; / &nbsp;
      <span class="breadcrumb-item active">{{ $subcatifo->subcat_name }}</span>
    </nav>

    <div class="sl-pagebody">
        <div class="top mb-5">
			<div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header"> Subcategory</div>
                    <div class="card-body">
                        @error('subcat')
                            <div class="alert alert-warning">{{ $message }}</div>
                        @enderror
                        @if (session('updatemsg'))
                        <div class="alert alert-success">{{ session('updatemsg') }} <a href="{{ url('subcategory') }}">View SubCategory</a></div>
                        @endif
                        <form action="{{ url('subcategory/update') }}" method="post">
                            @csrf

                            @foreach ($subcat as $row)
                            <input type="hidden" name="hidid" value="{{ $row->id }}">
                        <div class="form-group">
                            <label for="cat">Category</label>
                                <select name="cat" id="cat" class="form-control">
                                    @foreach ($cat as $catRow)
                                    <option @if($catRow->id == $row->cat_id) selected @endif  value="{{ $catRow->id }}">{{ $catRow->category_name }}</option>
                                    @endforeach

                                </select>

                        </div>
                        <div class="form-group">
                           <label for="subcat">SubCategory</label>

                           <input type="text" class="form-control" name="subcat" value="{{ $row->subcat_name }}" id="subcat">
                           @endforeach

                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Update" name="update">
                        </div>
                        </form>
                    </div>
                </div>
			</div>

		</div>

	</div>
 </div>
@endsection


