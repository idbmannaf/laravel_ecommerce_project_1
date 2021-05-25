<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\CatPractice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CatPracticeController extends Controller
{
    public function index(){
        $table= User::simplePaginate(2);
        $count= User::count();
        // $table= CatPractice::select('select * from users');
        return view('CatPractice',compact('table','count'));
    }
    public function insert(Request $request){
        CatPractice::insert([
            'CatName'=>$request->CatName,
            'auth'=>Auth::id(),
            'created_at'=>Carbon::now()
        ]);
        return back()->with('msg','Cat Added');

    }
}
