
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
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        {{--
                        @if (session('erro_status'))
                        <div class="alert alert-warning">{{ session('erro_status') }}</div>
                        @endif --}}
                        @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                        @error('catName')
                            <div class="alert alert-warning">
                                {{ $message }}
                            </div>
                        @enderror
                        <form method="POST" action="{{ url('category/insert') }}">
                            @csrf
                            <div class="form-group">
                                <label for="catName">Category Name</label>
                                <input type="text" name="catName" id="catName"  class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Add Category" class="form-control btn btn-info">
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
		<div class="bottom">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between"><h5>Category List</h5> <h5>Total Category({{ $totalCat }})</h5></div>
                <div class="card-body">
                    @if (session('delmsg'))
                        <div class="alert alert-danger"> {{ session('delmsg') }}</div>
                    @endif
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>User Email</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    @foreach ($catlist as $key=>  $row)

                        <tr>
                            <td> {{ $catlist->firstItem() + $key}}</td>
                            <td> {{ $row->category_name }}</td>
                            <td> {{ App\Models\User::find($row->added_by)->name }}</td>
                            <td> {{ App\Models\User::find($row->added_by)->email }}</td>
                            {{-- <td> {{ $row->added_by }}</td> --}}
                            <td> {{ $row->created_at->diffForHumans() }}</td>
                            <td width="10%"> <a class="btn btn-sm btn-warning me-1" href="{{ url('category/edit/') }}/{{ $row->id }}"><i class="far fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger" href="{{ url('category/del/') }}/{{ $row->id }}" onclick="return confirm('You want To delete  {{ $row->category_name }} Category ?');" ><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>



                    @endforeach
                </tbody>
                </table>
                <div class="pagination">
                    {{ $catlist->links() }}
                </div>
                </div>
            </div>
		</div>
	</div>
 </div>
@endsection
