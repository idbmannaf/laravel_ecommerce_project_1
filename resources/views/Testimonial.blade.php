
@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a  href="{{ url('home') }}">Dashboard</a> /
        <span class="breadcrumb-item active">Testimonial</span>
      </nav>

    <div class="sl-pagebody">
        <div class="top mb-5">
			<div class="col-md-4 m-auto">
                <div class="card">
                    <div class="card-header text-center">Add Testimonial</div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('errorstatus'))
                        <div class="alert alert-danger">{{ session('errorstatus') }}</div>
                        @endif
                        <form method="POST" action="{{ url('testmonial/insert') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="name">Client Name</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                   <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input class="form-control" type="text" name="designation" id="designation">
                                @error('designation')
                                <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="said">Review</label>
                                <textarea class="form-control" name="said" id="said"  rows="4"></textarea>
                                @error('said')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group">
                                <label for="designation">Client Photo</label>
                                <input class="form-control-file" type="file" name="photo" id="photo">
                                @error('photo')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                            </div>
                            <div class="form-group mb-0">
                                <input class="form-control btn btn-info" type="submit" value="Add Testimonial" name="subcategory">
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
        <div class="middle">

            <div class="card">
                <div class="card-header"><h5>Testimonials</h5>  </div>
                <div class="card-body">
                    @if (session('delMsg'))
                        <div class="alert alert-danger">{{ session('delMsg') }}</div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#SL</th>
                            <th>Client Name</th>
                            <th>Review</th>
                            <th>Designation</th>
                            <th>Photo</th>
                            <th>Created</th>
                            <th>Acation</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($testimonial as $key => $msg)
                            <tr>
                                 <td>{{ $loop->index +1  }}</td>
                                <td>{{ $msg->client_name }}</td>
                                <td>{{ $msg->said}}</td>
                                <td>{{ $msg->designation}}</td>
                                <td><img width="80px" src="{{ asset('uploads/testimonial_photos').'/'.$msg->photo }}" alt=""></td>
                                <td>{{ $msg->created_at->diffForHumans() }}</td>
                                <td width="10%">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#example{{ $msg->id }}" class="btn btn-sm btn-primary"><i class="far fa-edit"></i></button>
                                        <button  class="btn btn-sm btn-danger" onclick="return confirm('Are you Sure for Delete This Category');"><i class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="50" class="text-center text-danger">Data Not Found</td></tr>
                            {{-- Model Start  --}}
                            <div class="modal fade" id="#example{{ $msg->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Testimonial</h4>
                                            <button class="btn-close" data-bs-dismiss="modal" area-lable='close'></button>
                                        </div>
                                        <div class="modal-body">
                                            Hello
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Model End  --}}
                        @endforelse
                        </tbody>
                    </table>

                    {{-- {{ $subcatlist->links() }} --}}
                    {{-- uporer pagination change korle necher ta change hobena  START --}}
                {{-- {{ $subcatlist->appends(['deleted_sub_category' => $delCat->currentPage()])->links() }} --}}
                {{-- uporer pagination change korle necher ta change hobena  END --}}
                </div>


        </div>
		{{-- <div class="bottom">
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
                           @forelse ($testimonial as $key => $subcat)
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
                        {{-- {{ $testimonial->appends(['sub_category' => $subcatlist->currentPage()])->links() }} --}}
                        {{-- uporer pagination change korle necher ta change hobena  END --}}
                    {{-- {{ $delCat->appends(['sub_category'=>$subcatlist->currentPage()]) ->links() }} --}}
                </div>
                </div>
		</div> --}}
	</div>
</div>
@endsection
