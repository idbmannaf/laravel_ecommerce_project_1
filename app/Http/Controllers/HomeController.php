<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_details;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admincheck');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo User::all();
        // $users = User::all(); // For All data from users Table
        $users = User::orderBy('created_at','desc')->paginate(5,['*'],'user');  // For Pagination
        $total= User::count();
        $order_by_id=Order::where('user_id', Auth::id())->get();
        return view('home',compact('users','total','order_by_id'));
    }

    //Insert User by admin
    public function insert_user(Request $request)
    {
        $request->validate([
            'email'=>'unique:users,email|email',
            'password'=>'required|min:5',
        ]);
       User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'created_at'=>Carbon::now()
       ]);
       return back()->with('error_status','User Succesfully added');
    }
    public function download_invoice($order_id){
        $user= User::find($order_id)->name;
        $data= Order::find($order_id);
        $order_details= Order_details::where('order_id',$order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('data','order_details'));
        return $pdf->download($user.'_'.$order_id.'_'.rand(2000,5000).'_invoice.pdf');

    }
}
