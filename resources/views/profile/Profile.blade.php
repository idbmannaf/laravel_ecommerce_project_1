@extends('layouts.admin')
@section('content')
@include('layouts.nav')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a  href="{{ url('home') }}">Dashboard</a> &nbsp; / &nbsp;
      <span class="breadcrumb-item active">Profile</span>
    </nav>

    <div class="sl-pagebody">
        <div class="col-md-6 m-auto">
            <div class="card shadow">
                <div class="card-header bg-info text-center text-white"><h3>Profile Details</h3></div>
                <div class="card-body">
                   <div class="profile_img text-center "><img class="border border-5 rounded-circle shadow" width="250px" height="250px" src="{{ asset('uploads/profile_photos/').'/'.Auth::user()->photo }}"></div>
                </div>
                <table class=" table table-striped">
                    <tr>
                        <td width="10%"></td>
                        <th width='50%'>Name :</th>
                        <td width="50%">{{ Auth::user()->name }}</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <th width='50%'>Email :</th>
                        <td width="50%">{{ Auth::user()->email }}</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <th width='50%'>Created :</th>
                        <td width="50%">{{ Auth::user()->created_at->format('d/m/Y') }} </td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <th width='50%'>Updated :</th>
                        <td width="50%">{{ Auth::user()->updated_at->format('d/m/Y') }}</td>
                        <td width="10%"></td>
                    </tr>
                    <tr>
                        <td width="10%"></td>
                        <th width='50%'>Verifyed :</th>
                        <td width="50%">
                            @if (Auth::user()->email_verified_at)
                            <span style="color:green">Verified</span>
                            @else
                            <span style='color:red'>Unverified</span>
                            @endif
                        </td>
                        <td width="10%"></td>
                    </tr>


                </table>
            </div>
        </div>
	</div>
</div>
@endsection
