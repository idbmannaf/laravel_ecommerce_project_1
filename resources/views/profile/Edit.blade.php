@extends('layouts.admin')
@section('content')
@include('layouts.nav')

 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <a href="{{ url('profile') }}">View Profile</a> &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Update Profile</span>
    </nav>

    <div class="sl-pagebody">
       <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">Change Name</div>
                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}  <a class="" href="{{ url('profile') }}"> View Profile</a></div>
                    @endif
                    <form method="POST" action="{{ url('profile/update') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text"  name="name" value="{{ Auth::user()->name }}" class="form-control" placeholder="Enter your Name">
                          </div>
                      <button type="submit" class="btn btn-info btn-block">Update</button>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }} </div>
                    @endif
                    <form method="POST" action="{{ url('profile/password/change') }}">
                        @csrf
                        <div class="form-group">
                            <input type="password"  name="oldpassword"class="form-control" placeholder="Old Password">
                            @error('oldpassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group">
                            <input type="password"  name="password"class="form-control" placeholder="New Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                          </div>
                        <div class="form-group">
                            <input type="password"  name="password_confirmation"class="form-control" placeholder="Confirmation Password">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                      <button type="submit" class="btn btn-info btn-block">Change Password</button>
                      </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">Change Profile Photo</div>
                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success">{{ session('msg') }}  <a class="" href="{{ url('profile') }}"> View Profile</a></div>
                    @endif
                    <form method="POST" action="{{ url('profile/photo/change') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group text-center mb-2">
                            <label>Current Profile Photo</label> <br>
                            <img src="{{ asset('uploads/profile_photos') }}/{{ Auth::user()->photo }}" class=" wd-100 rounded-2" alt="Deafult Image" >
                        </div>

                        <div class="form-group">
                            <input type="file"  name="new_profile_photo"  class="form-control-file" >
                            @error('new_profile_photo')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                          </div>
                      <button type="submit" class="btn btn-info btn-block">Update Image</button>
                      </form>
                </div>
            </div>
        </div>
       </div>
	</div>
</div>
<!-- ########## END: MAIN PANEL ########## -->
@endsection
