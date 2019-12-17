<?php
namespace App\Controllers;

class IndexController extends Controller{

    public function test($id){
        return $id;
    }
    public function test2(){
        $id= 4;
        return view('index',compact('id'));
    }

}