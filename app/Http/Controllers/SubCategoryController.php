<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SubCategoryController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admincheck');
    }
    public function index()
    {

        $catlist = Category::all();
        $count = SubCategory::count();
        $subcatlist = SubCategory::orderBy('created_at', 'desc')->paginate(5, ['*'], 'sub_category'); // Decending order e dekhabe
        $delCat = SubCategory::orderBy('deleted_at', 'desc')->onlyTrashed()->paginate(5, ['*'], 'deleted_sub_category');
        return view('category.SubCategory', compact('catlist', 'subcatlist', 'delCat', 'count'));
    }

    //Insert Subcategoy
    public function insert(Request $request)
    {
        // echo $request->CatId;
        // echo $request->subCat;

        $request->validate([
            'CatId' => 'required',
            'subCat' => 'required'
        ], [
            'CatId.required' => 'Please Select Category',
            'subCat.required' => 'Field must not be empty',

        ]);

        if (SubCategory::withTrashed()->where('cat_id', $request->CatId)->where('subcat_name', $request->subCat)->exists()) { // Jodi value alreay thake tahole value dhukte dibena
            return back()->with('errorstatus', 'Subcategory Already Exist in this category');
        } else {
            SubCategory::insert([
                'cat_id' => $request->CatId,
                'subcat_name' => $request->subCat,
                'created_at' => Carbon::now()
            ]);
            return back()->with('status', 'Subcategory Added Succesfully');
        }
    }
    // Delete Subcategory
    public function delete($delId)
    {
        SubCategory::find($delId)->delete();
        return back()->with('delMsg', 'Subcategory Deleted');
    }

    //Edit Category
    public function edit($editId)
    {
        $cat = Category::all();
        $subcat = SubCategory::where('id', $editId)->get();
        $subcatifo= SubCategory::find($editId);
        return view('category.EditSubCategory', compact('subcat', 'cat','subcatifo'));
    }
    //Update Category
    public function update(Request $request)
    {
        $udate = Carbon::now();
        $request->validate([
            'subcat' => 'required|unique:sub_categories,subcat_name'
        ]);
        SubCategory::where('id', $request->hidid)->update([
            'cat_id' => $request->cat,
            'subcat_name' => $request->subcat,
            'updated_at' => $udate
        ]);
        return back()->with('updatemsg', 'Subcategory Updated Succesfully');
    }
    //Restore Subcategory
    public function restore($restore)
    {
        SubCategory::withTrashed()->find($restore)->restore();
        return back();
    }
    public function permanenetDelete($pd)
    {
        SubCategory::withTrashed()->find($pd)->forceDelete();
        return back();
    }
    //Mark And Delete
    public function markDelete(Request $request)
    {

        foreach ($request->mark_delete as $deleteItem) {
            SubCategory::find($deleteItem)->delete();

        }
        return back();
    }
}
