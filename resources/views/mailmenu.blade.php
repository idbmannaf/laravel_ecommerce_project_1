
@extends('layouts.admin')
@section('content')
@include('layouts.nav')
@if (Auth::user()->role == 2)

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a href="{{ url('home') }}">Dashboard</a>  &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Mailler</span>
    </nav>

    <div class="sl-pagebody">
        <div class="col-md-5 m-auto">
            @if (session('send_mail'))
              <h3 class="alert alert-primary text-success">{{ session('send_mail') }}</h3>
            @endif
        </div>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">Send Mail to Customar</div>
            <div class="card-body">
                <form action="{{ url('send/email') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <select class="form-control" name="email" id="">
                            <option value=""> Select a Customar</option>
                          @foreach ($all_customar as $customar)
                          <option value="{{ $customar->email }}">{{ $customar->email }} ({{ $customar->name }})</option>
                          @endforeach
                        </select>
                    </div>
                   <div class="form-group">
                       <label for="messege">Message</label>
                    <textarea class="form-control" name="messege" id="" cols="4" ></textarea>
                   </div>
                   <div class="form-group mb-0">
                    <button class="btn btn-info form-control" type="submit">Send</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-info text-white">Send Mail to admin</div>
        <div class="card-body">
            <form action="{{ url('send/email') }}" method="post">
                @csrf

                <div class="form-group">
                    <select class="form-control" name="email" id="">
                        <option value=""> Select a Admin</option>
                      @foreach ($all_admin as $customar)
                      <option value="{{ $customar->email }}">{{ $customar->email }} ({{ $customar->name }})</option>
                      @endforeach
                    </select>
                </div>
               <div class="form-group">
                   <label for="messege">Message</label>
                <textarea class="form-control" name="messege" id="" cols="4" ></textarea>
               </div>
               <div class="form-group mb-0">
                <button class="btn btn-info form-control" type="submit">Send</button>
               </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-info text-white">Send Mail to Anyone</div>
        <div class="card-body">
            <form action="{{ url('send/email') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">Enter Email</label>
                <input class="form-control" type="text" name="email" >
                </div>
               <div class="form-group">
                   <label for="messege">Message</label>
                <textarea class="form-control" name="messege" id="" cols="4" ></textarea>
               </div>
               <div class="form-group mb-0">
                <button class="btn btn-info form-control" type="submit">Send</button>
               </div>
            </form>
        </div>
    </div>
</div>
</div>
	</div>
 </div>
     @elseif (Auth::user()->role != 2)
     {{-- {{ Redirect::to('/home') }} --}}
     <script>window.location = "/home";</script>
@endif
@endsection
