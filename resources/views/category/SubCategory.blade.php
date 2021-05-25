
@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a  href="{{ url('home') }}">Dashboard</a> /
        <span class="breadcrumb-item active">Sub Category</span>
      </nav>

    <div class="sl-pagebody">
        <div class="top mb-5">
			<div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header text-center">Add Subcategory</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('errorstatus'))
                        <div class="alert alert-danger">{{ session('errorstatus') }}</div>
                        @endif

                        @error('CatId')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        @error('subCat')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror

                        <form method="POST" action="{{ url('subcategory/insert') }}">
                        @csrf
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" name="CatId" id="category">
                                    <option value="">Select a Category</option>
                                    @foreach ($catlist as $cat)
                                        <option {{ old('CatId') ==$cat->id? 'selected': '' }}  value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subCat">Subcategoy</label>
                                <input class="form-control" type="text" name="subCat" id="subCat">
                            </div>
                            <div class="form-group mb-0">
                                <input class="form-control btn btn-info" type="submit" value="Add SubCategory" name="subcategory">
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
        <div class="middle">
            <div class="card">
                <div class="card-header d-flex justify-content-between bg-info text-white"><h5>Sub Category List</h5> <h5>Total Sub Category ({{ $count }})</h5></div>
                <div class="card-body">
                    @if (session('delMsg'))
                        <div class="alert alert-danger">{{ session('delMsg') }}</div>
                    @endif
                    <form action="{{ url('subcategory/mark/delete') }}" method="POST">
                        @csrf
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Mark</th>
                            <th>#SL</th>
                            <th>Subcategory</th>
                            <th>Category</th>
                            <th>Created</th>
                            <th>Acation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($subcatlist as $key => $subcat)
                            <tr>
                                <td class="text-center"><input class="form-check-input" name="mark_delete[]" value="{{ $subcat->id }}"  type="checkbox" name="mark"></td>
                                <td>{{ $subcatlist->firstItem() + $key  }}</td>
                                <td>{{ $subcat->subcat_name }}</td>
                                <td>{{ App\Models\Category::find($subcat->cat_id)->category_name }}</td>
                                <td>{{ $subcat->created_at->diffForHumans() }}</td>
                                <td width="10%">
                                <a href="{{ url('subcategory/edit/') }}/{{ $subcat->id }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></a>
                                        <a href="{{ url('subcategory/del/') }}/{{ $subcat->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you Sure for Delete This Category');"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="50" class="text-center text-danger">Data Not Found</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-danger mb-2">Mark Delete</button>
                </form>
                    {{-- {{ $subcatlist->links() }} --}}
                    {{-- uporer pagination change korle necher ta change hobena  START --}}
                {{ $subcatlist->appends(['deleted_sub_category' => $delCat->currentPage()])->links() }}
                {{-- uporer pagination change korle necher ta change hobena  END --}}
                </div>
            </div>

        </div>
		<div class="bottom">
            <div class="card">
                <div class="card-header bg-info text-white text-center fw-bolder">Deleted Sub Category List</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>#SL</th>
                            <th>Subcategory</th>
                            <th>Category</th>
                            <th>Deleted</th>
                            <th>Acation</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse ($delCat as $key => $subcat)
                               <tr>
                                   <td>{{ $delCat->firstItem() + $key  }}</td>
                                   <td>{{ $subcat->subcat_name }}</td>
                                   <td>{{ App\Models\Category::find($subcat->cat_id)->category_name }}</td>
                                   <td>{{ $subcat->deleted_at->diffForHumans() }}</td>
                                   <td width='10%'>
                                           <a href="{{ url('subcategory/restore/') }}/{{ $subcat->id }}" class="btn btn-sm btn-success" onclick="return confirm('You Want to Restore this Subcategory');"><i class="fas fa-trash-restore"></i></a>
                                           <a  title="Permanent Delete" href="{{ url('subcategory/pdelete/') }}/{{ $subcat->id }}" class="btn btn-sm btn-danger" onclick="return confirm('You Want to Permanenet Delete this Subcategory');"><i class="far fa-trash-alt"></i></a>
                                   </td>
                               </tr>
                               @empty
                               <tr><td colspan="50" class="text-center text-danger">Data Not Found</td></tr>
                           @endforelse
                        </tbody>
                    </table>
                    {{-- {{ $delCat->links() }} --}}
                        {{-- uporer pagination change korle necher ta change hobena  START --}}
                        {{ $delCat->appends(['sub_category' => $subcatlist->currentPage()])->links() }}
                        {{-- uporer pagination change korle necher ta change hobena  END --}}
                    {{-- {{ $delCat->appends(['sub_category'=>$subcatlist->currentPage()]) ->links() }} --}}
                </div>
                </div>
		</div>
	</div>
</div>
@endsection
