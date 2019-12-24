<?php
namespace App\Controllers;

use App\Models\User;

class IndexController extends Controller{

    public function test($id){
        $user = User::where('id',$id)->first();
        return $user;
    }
    public function test2(){
        $id= 4;
        return view('index',compact('id'));
    }

}