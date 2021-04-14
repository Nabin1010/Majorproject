<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Mail\SendMailUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index(){
        return view('contactus');
    }

    public function send(Request $request){
        // return $request;
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message'=>'required',
        ]);
        $data = array(
            'name' => $request->name,
            'message' => $request->message,
            'email' =>$request->email
            
        );
        // dd($data);
        $mail = ['kattelnabin69@gmail.com',$request->email];

        Mail::to($mail)->send(new SendMail($data));
        return back()->with('success','Thanks for Contrating us!');

    }
}
