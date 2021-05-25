@extends('layouts.fronend')
@section('content')
<div class="col-md-6 m-auto">
    <div class="card my-4 text-center">
        <div class="card-header">

            <h4 class="text-danger">you are not verifyed</h4>
<form action="{{ route('verification.send') }}" method="post">
@csrf
<button type="submit" class="btn btn-info">Resend Mail</button>
</form>
        </div>
    </div>
</div>
@endsection
