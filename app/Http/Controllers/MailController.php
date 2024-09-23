<?php

namespace App\Http\Controllers;

use App\Mail\testMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

  public function index()
  {

    $mailData = [
      'title' => 'Mail from ItSolutionStuff.com',
      'body' => 'This is for testing email using smtp.'
    ];

    Mail::to('your_email@gmail.com')->send(new testMail($mailData));

    dd("Email is sent successfully.");

  }

}
