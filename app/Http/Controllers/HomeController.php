<?php

namespace App\Http\Controllers;

use App\Models\TherapistVerification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $therapists = TherapistVerification::limit(3)->get();
        return view('landing', compact('therapists'));
    }
}
