<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('home', ['feedbacks' => $feedbacks,]);
    }
}
