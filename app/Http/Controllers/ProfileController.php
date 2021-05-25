<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
// use Image;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Stmt\Echo_;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function Profile()
    {
        $car = ['bmw', 'toyota', 'padaru', 'volvo'];
        return view('profile.Profile', compact('car'));
    }
    public function editprofile()
    {
        return view('profile.Edit');
    }

    // Name Update
    public function update(Request $request)
    {
        // print_r($request->all());
        // User::where('id',Auth::id())->update([    // This is also Working
        //     'name'=>$request->name
        // ]);

        User::find(Auth::id())->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('msg', 'User Updated Successfully');
    }
    //Change Password
    public function passwordChange(Request $request)
    {
        $request->validate([
            'password' => 'confirmed | required',
            'oldpassword' => 'required',
            'password_confirmation' => 'required'
        ]);
        //Strong Password Start
        if (preg_match('@[A-Z]@', $request->password) . preg_match('@[a-z]@', $request->password) . preg_match('@[0-9]@', $request->password) . preg_match("#[\\~\\`\\!\\@\\#\\$\\%\\^\\&\\*\\(\\)\\_\\-\\+\\=\\{\\}\\[\\]\\|\\:\\;\\&lt;\\&gt;\\.\\?\\/\\\\\\\\]+#", $request->password) == "1111") { // Jodi Condiation Mile tahole 1111 asbe.
            //Strong Password End

            if (Hash::check($request->oldpassword, Auth::user()->password)) {  /// Check Password Mileche na mileni
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('success', 'Password Succesfully Chenged!');
            } else {
                return back()->with('error', 'Old Password Dose Not Match!');
            }
        } else {
            return back()->with('error', 'Password Not Strong! Example A2a . And Must A special Charecter');
        }
    }

    //Photo Change
    public function imageChange(Request $request)
    {
        $request->validate([
            'new_profile_photo' => 'required | mimes:jpg,bmp,png,svg,gif |max:500'
        ]);

        if (Auth::user()->photo !='default.png') {
           $path =public_path().'/uploads/profile_photos/'. Auth::user()->photo;
           unlink($path);
        }
    $newProfilePhtot= $request->file('new_profile_photo');
    $newProfilePhotoName= Auth::id().".".$newProfilePhtot->getClientOriginalExtension();
    Image::make($newProfilePhtot)->resize(280, 280)->save(base_path('public/uploads/profile_photos/'.$newProfilePhotoName));
    User::where('id',Auth::id())->update([
        'photo'=>$newProfilePhotoName
    ]);
    return back();
    }
}
