<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $feedbacks = Feedback::all();
        return view('user.dashboard', [
            'user' => $user,
            'feedbacks' => $feedbacks,
        ]);
    }

    public function ownerFeedback()
    {
        $user = auth()->user();
        $feedbacks = Feedback::where('user_id', $user->id)->get();
        return view('user.my-feedbacks', [
            'user' => $user,
            'feedbacks' => $feedbacks,
        ]);
    }
}
