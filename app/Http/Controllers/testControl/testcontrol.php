<?php

namespace App\Http\Controllers\testControl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Class testControl extends Controller{
    public function testControl(){
        return view('testControl.testcontrol');
    }

}
