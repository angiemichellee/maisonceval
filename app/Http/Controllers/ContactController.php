<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    public function contact()
    {
        // $contact is shared with every view (see AppServiceProvider).
        return view('contact');
    }
}
