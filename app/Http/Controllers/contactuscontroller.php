<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactuscontroller extends Controller
{
    public function index(){
        return view('contactus');
    }

    public function store(Request $request){
        $name=$request->name;
        $msg=$request->msg;
        $subject=$request->subject;
        $email=$request->email;


      Mail::send('email.contact',compact('name','email','msg','subject') ,function($message) use ($email,$subject){

        $message->to($email);
        $message->subject($subject);
      });

      return back()->with('success','thank you for contacting us');
    }
}
