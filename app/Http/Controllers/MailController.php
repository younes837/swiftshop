<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SignUp;
use Mail;
class MailController extends Controller
{
    public function sendMail(){
        Mail::to('ynsors2002@gmail.com')->send(new SignUp());
        return view('emails.index');
    }
}
