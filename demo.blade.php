@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Sub Category</span>
    </nav>

    <div class="sl-pagebody">
        
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->
@endsection