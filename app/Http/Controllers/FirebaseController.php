<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseController extends Controller
{
    /**
     * otp view.
     *
     * @return view
     */
    public function otp()
    {
        return view('otp');
    }
}
