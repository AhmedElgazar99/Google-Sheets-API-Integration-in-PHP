<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class filecontroller extends Controller
{
    public function index()  {

        return view('note.uploadfile');
        
    }

    public function  upload(Request $request) {
        $file=$request->file('img');
    

        $filename=$file->getClientOriginalName();

//php artisan storage:link
        $file->storeAs('public/uploads',$filename);
        return back()->with('success','file uploaded succesfuly')->with('image',$filename);
    }
}
