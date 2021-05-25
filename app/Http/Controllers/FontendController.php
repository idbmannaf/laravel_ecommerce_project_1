<?php

namespace App\Http\Controllers;

use App\Mail\sendemail;
use App\Mail\sendinvoice;
use App\Models\testimonial;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Image;
use PDF;


class FontendController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        $products = Product::orderBy('created_at', 'desc')->paginate(8, ['*'], 'product_page');
        $testimonial = testimonial::latest()->get();
        return view('welcome', compact('products', 'category', 'testimonial'));
    }
    // Product Details
    public function product_details($product_id)
    {

        $category_id = Product::find($product_id)->cat_id;
        $reletadeProduct =  Product::where('cat_id', $category_id)->where('id', '!=', $product_id)->get();
        return view('productdetails', [
            'product_details' => Product::find($product_id),
            'reletadeProduct' => $reletadeProduct
        ]);
    }

    public function About()
    {
        return view('About');
    }
    public function Contact()
    {
        return view('Contact');
    }
    public function Portfolio()
    {
        return view('Protfolio');
    }

    //>>>>>>>>>>>>> For Admin   >>>>>>>>>>>>>>
    public function testimonialIndex()
    {
        return view('Testimonial', [
            'testimonial' => testimonial::latest()->get()
        ]);
    }
    public function testimonialInsert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'said' => 'required |max:300',
            'photo' => 'required|mimes:png,jpg,gif',

        ]);
        $tmp_photo = $request->file('photo');
        $extention = $tmp_photo->getClientOriginalExtension();
        $new_photo_name = rand(1, 100) . "-" . str_replace(" ", "-", $request->name) . "." . $extention;
        if (Image::make($tmp_photo)->save(base_path('public/uploads/testimonial_photos/' . $new_photo_name))) {
            testimonial::insert([
                'client_name' => $request->name,
                'said' => $request->said,
                'designation' => $request->designation,
                'photo' => $new_photo_name,
                'created_at' => Carbon::now()
            ]);
            return back()->with('status', 'Testimonial Succesfully added');
        }
    }


    //Shop
    public function shop()
    {

        return view('shop', [
            'all_products' => Product::latest()->get(),
            'all_category' => Category::latest()->get()
        ]);
    }
    public function shop_category($category_id)
    {

        //    return $category_id;
        return view('shopcategory', [
            'cat_id' => Category::find($category_id)->category_name,
            'catwaise_products' => Product::where('cat_id', $category_id)->get()
        ]);
    }

    //Search Section
    public function search()
    {
        $q = $_GET['q'];
        if ($_GET['filter'] == 'Z-A') {
            $search_result = Product::where('product_name', 'like', '%' . $q . '%')->where('product_details', 'like', '%' . $q . '%')->orderBy('product_name', 'desc')->paginate(5, ['*'], 'search_page');
        } else {
            $search_result = Product::where('product_name', 'like', '%' . $q . '%')->where('product_details', 'like', '%' . $q . '%')->orderBy('product_name', 'asc')->paginate(5, ['*'], 'search_page');
        }
        return view('search', [
            'search_result' => $search_result,
            'search_by' => $q
        ]);
    }
    //My Order
    public function myorder()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(5, ['*'], 'user');  // For Pagination
        $total = User::count();
        $order_by_id = Order::where('user_id', Auth::id())->get();
        return view('myorder', compact('users', 'total', 'order_by_id'));
    }
    public function download_invoice($order_id)
    {
        $user = Auth::user()->name;
        $data = Order::find($order_id);
        $order_details = Order_details::where('order_id', $order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('data', 'order_details'));
        return $pdf->download($user . '_' . $order_id . '_' . rand(2000, 5000) . '_invoice.pdf');
    }
    // Send order Details via Email start
    public function send_mail_invoice($order_id)
    {
        // Use commend php arisan make:mail
        Mail::to(Auth::user()->email)->send(new sendinvoice($order_id));
        return back()->with('invoice_send',"invoice Send");
    }

    //mail menu
    public function mailmenu(){
        $all_customar= User::where('role','1')->get();
        $all_admin= User::where('role','2')->get();
        return view('mailmenu',[
            'all_customar'=>$all_customar,
            'all_admin'=>$all_admin,
        ]);
    }
    public function sendemail(Request $request)
    {
         // Use commend php arisan make:mail sendemail
        Mail::to($request->email)->send(new sendemail($request->messege));
        return back()->with('send_mail','Mail succefully Send');
    }
        // Send order Details via Email End
}
