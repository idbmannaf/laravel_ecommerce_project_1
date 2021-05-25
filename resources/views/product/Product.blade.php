@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Product</span>
    </nav>


    <div class="sl-pagebody">
        <div class="add_product mb-3">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">

                        @if (session('error'))
                        <div class="alert alert-warning">{{ session('error') }}</div>
                        @endif
                        @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                        @endif

                        <form class="" method="POST" action="{{ url('product/insert') }}" enctype="multipart/form-data">
                             @csrf

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cat_id">Category Name</label>
                                    <select class="form-control" name="cat_id" id="cat_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cat_id')
                                    <span class="text-warning">
                                        {{ $message }}
                                    </span>
                                @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="subcat_id">Subcategory Name</label>
                                    <select class="form-control" name="subcat_id" id="subcat_id">
                                        <option value="">Select Subcategory</option>
                                        @foreach ($sub_categories as $subCat)
                                        <option value="{{ $subCat->id }}">{{ $subCat->subcat_name }} - {{ App\Models\Category::find($subCat->cat_id)->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcat_id')
                                    <span class="text-warning">
                                        {{ $message }}
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name"  class="form-control">
                                    @error('product_name')
                                    <span class="text-warning">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_details">Product Details</label>
                            <textarea class="form-control" name="product_details" id="product_details" rows="4">{{old('product_details')}}</textarea>
                            @error('product_details')
                            <span class="text-warning">
                                {{ $message }}
                            </span>
                                @enderror
                            </div>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="product_quantity">Product Quantity</label>
                                        <input type="number" class="form-control" name="product_quantity" id="product_quantity" value="{{old('product_quantity')}}">
                                        @if (session('quantity'))
                                        <span class="text-warning">{{ session('quantity') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_price">Product Price</label>
                                        <input type="number" class="form-control" name="product_price" id="product_price">
                                        @if (session('price'))
                                        <span class="text-warning">{{ session('price') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_photo">Product Photo</label>
                                        <input type="file" class="form-control-file" name="product_photo" id="product_photo">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="product_photo">Product Thumbnails Photos</label>
                                        <input type="file" class="form-control-file" name="thumbnails_photos[]" id="product_photo" multiple>
                                    @error('thumbnails_photos')
                                    <span class="text-warning">{{ $message }}</span>
                                    @enderror
                                    </div>

                                    <div class="form-group col-md-12 m-auto text-center">
                                        {{-- <button type="submit" class="form-control btn btn-info">Add Product</button> --}}
                                        <input type="submit" name="submit" value="Add Product" class=" btn btn-info btn-lg">
                                    </div>
                                </div>

                         </form>

                    </div>
                </div>
            </div>
        </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white d-flex justify-content-between"><h5>Product List</h5> <h5>Total Category()</h5></div>
                    <div class="card-body">
                        @if (session('delstatus'))
                            <div class="alert alert-danger"> {{ session('delstatus') }}</div>
                        @endif

                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Added By</th>
                                    <th>Category </th>
                                    <th>Sub Category </th>
                                    <th>Product Title</th>
                                    <th>Product Details</th>
                                    <th>Quentity</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                               @forelse ($products as $key=> $row)
                               <tr>
                                <td> {{ $products->firstItem() + $key  }}</td>
                                <td> {{ App\Models\User::find($row->user_id)->name }}</td>
                                <td> {{ App\Models\Category::find($row->cat_id)->category_name }}</td>
                                <td> {{  App\Models\Subcategory::find($row->subcat_id)->subcat_name }}</td>
                                <td> {{ $row->product_name }}</td>
                                <td title="{{ $row->product_details }}"> {{ substr($row->product_details,0,30)  }}</td>
                                <td > {{ $row->product_quantity }}</td>
                                <td> {{ $row->product_price }}</td>
                                {{-- <td> {{ $row->product_photo }}</td> --}}
                                <td> <img class="rounded-10" width="60px" height="60px" src="{{ asset('uploads/product_photos')."/".$row->product_photo }}"></td>
                                <td> {{ $row->created_at->format('y/m/d') }}</td>
                                <td width="14%" class="text-center ">
                                    <a class="btn btn-sm btn-success" href="{{ url('product/view/') }}/{{ $row->id }}" ><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-sm btn-warning  my-1" href="{{ url('product/edit/') }}/{{ $row->id }}"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('product/del/') }}/{{ $row->id }}" onclick="return confirm('You want To delete  {{ $row->product_name }} Category ?');" ><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                               @empty
                                <tr><td class="text-danger text-center" colspan="50"> Product Not Found</td></tr>
                               @endforelse


                            </tbody>
                    </table>
                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                    </div>
            </div>

            {{-- Deleted Product  --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white d-flex justify-content-between"><h5>Product List</h5> <h5>Total Category()</h5></div>
                    <div class="card-body">
                        @if (session('delmsg'))
                            <div class="alert alert-danger"> {{ session('delmsg') }}</div>
                        @endif
                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Added By</th>
                                    <th>Category </th>
                                    <th>Sub Category </th>
                                    <th>Product Title</th>
                                    <th>Product Details</th>
                                    <th>Quentity</th>
                                    <th>Price</th>
                                    <th>Image</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                               @forelse ($Deleted_Product as $key=> $row)
                               <tr>
                                <td> {{ $products->firstItem() + $key  }}</td>
                                <td> {{ App\Models\User::find($row->user_id)->name }}</td>
                                <td> {{ App\Models\Category::find($row->cat_id)->category_name }}</td>
                                <td> {{  App\Models\Subcategory::find($row->subcat_id)->subcat_name }}</td>
                                <td> {{ $row->product_name }}</td>
                                <td title="{{ $row->product_details }}"> {{ substr($row->product_details,0,30)  }}</td>
                                <td > {{ $row->product_quantity }}</td>
                                <td> {{ $row->product_price }}</td>
                                {{-- <td> {{ $row->product_photo }}</td> --}}
                                <td> <img class="rounded-10" width="60px" height="60px" src="{{ asset('uploads/product_photos')."/".$row->product_photo }}"></td>
                                <td> {{ $row->created_at->format('y/m/d') }}</td>
                                <td width="14%" class="text-center ">
                                    <a class="btn btn-sm btn-success" href="{{ url('product/view/') }}/{{ $row->id }}" ><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-sm btn-warning  my-1" href="{{ url('product/edit/') }}/{{ $row->id }}"><i class="far fa-edit"></i></a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('product/del/') }}/{{ $row->id }}" onclick="return confirm('You want To delete  {{ $row->product_name }} Category ?');" ><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                               @empty
                                <tr><td class="text-danger text-center" colspan="50"> Product Not Found</td></tr>
                               @endforelse


                            </tbody>
                    </table>
                    <div class="pagination">
                        {{-- {{ $products->links() }} --}}
                       @foreach ($Deleted_Product as $va)
                           <tr>{{ $va->id }}</tr>
                       @endforeach
                    </div>
                    </div>
            </div>
        </div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->
@endsection

@section('script')
{{-- $(document).ready(function(){
    $("#subcat").on('change',function(e){
       var d= $(this).val();
        $.ajax({
            url: "{{ url('product2') }}",
            method: 'get',
            data: {id:d},
            success:function(response){
                alert(response)
            }
        });
    })
}); --}}
@endsection
