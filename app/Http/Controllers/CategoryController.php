<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; // Use for insert Data
use App\Models\Product;
use App\Models\SubCategory;

class CategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admincheck');
    }

    public function index()
    {
        $catlist = Category::orderBy('created_at','desc')->paginate(5);
        $totalCat= Category::count();
        // $catlist= Category::all();
        return view('category.Category', compact('catlist','totalCat'));
    }

//Insert Category
    public function insert(Request $request)
    {

        // print_r($obj->all()); // form er sob data dekhabe
        // $category_name= $request->catName; // Category Name Dhorbe
        // $added_by= Auth::id(); // Current User Id
        // $Name= Auth::user()->name; // Current User Name
        // $crate_at= Carbon::now(); // Current Time


        $request->validate([
            'catName' => 'required|unique:categories,category_name'
        ], [
            'catName.required' => "Category Koi Dilanato", // Jodi CatName er Required Error hoy thole ei MSG dekhabe
            'catName.unique' => "This Category Already Exist!" // Jodi CatName er Required Error hoy thole ei MSG dekhabe
        ]);
        Category::insert([
            'category_name' => $request->catName,
            'added_by' => Auth::id(),
            'created_at' => Carbon::now()
        ]);
        echo "Done";
        return back()->with('status', 'Catagory Added Successfully'); // Je page Theke Submit Koreche Sei page e jabe && with() methoder maddhome session set korbe
    }


    //Delete Category
    public function delete($cat_id)
    {
        Category::find($cat_id)->delete();
        // je category delete hobe tar sob subcategory and Post delete hobe START
        SubCategory::where([
            'cat_id'=>$cat_id
        ])->forceDelete();

        Product::where([
            'cat_id'=>$cat_id
        ])->forceDelete();


        // je category delete hobe tar sob subcategory and Post delete hobe End

        return back()->with('delmsg', 'Category Deleted');
    }


    //Edit Category
    public function edit($del_id)
    {
        //   $singleCat= Category::find($del_id);
        $singleCat = Category::where('id', $del_id)->get();
        return view('category.EditCategory', compact('singleCat'));
    }


    //Update Category
    public function update(Request $request)
    {
        $date= Carbon::now();
        Category::where('id', $request->hiddenid)->update([
            'category_name' => $request->uCatName,
            'updated_at' => $date

        ]);
        return back()->with('msg','Category Updated Succesfully');
    }

}
