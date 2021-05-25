@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Add Practice Category ({{ $count }})</div>
                <div class="card-body">
<table class="table table-stiped">

    <thead>
        <tr>
            <th>ID</th>
        <th>Name</th>
        <th>Created_at</th>
        </tr>
    </thead>
@foreach ($table as $row)
    <tr>
        <td>{{ $row->id }}</td>
        <td>{{ $row->name }}</td>
        <td>{{ $row->created_at }}</td>
    </tr>
@endforeach

</table>
<div class="pagination text-end">
    {{ $table->links() }}
</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Add Practice Category</div>
                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}</div>
                    @endif
                    <form method="POST" action="{{ url('catpractice/insert') }}">
                        @csrf
                        <div class="form-group">
                            <label for="CatName">Text</label>
                            <input id="CatName" class="form-control" type="text" name="CatName">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Add Cat" name="adcat" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
