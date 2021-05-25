@extends('layouts.admin')

@section('content')

@include('layouts.nav')



    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('home') }}">Dashboard</a>
      </nav>

      <div class="sl-pagebody">
        @if (Auth::user()->role == 1)
            @include('part.customardashboard')
            @elseif (Auth::user()->role ==2)
                @include('part.admindashboard')
            @elseif (Auth::user()->role == 3)
                @include('part.shopkeeperdashboard')
        @endif

      </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->








@endsection
