<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.new-feedback', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $feedback = Feedback::create([
            'user_id' => auth()->id(),
            'title' => $request->input('title'),
            'comment' => $request->input('comment'),
            'stars' => $request->input('stars'),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Feedback realizado com sucesso!');
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $feedback = Feedback::where('user_id', auth()->id())
            ->where('id', $request->input('id'))
            ->first();

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback não encontrado ou não pertence a este usuário.',
            ], 404);
        }

        $feedback->title = $request->input('title');
        $feedback->comment = $request->input('comment');
        $feedback->stars = $request->input('stars');
        $feedback->save();

        return response()->json([
            'success' => true,
            'message' => 'Feedback atualizado com sucesso!',
        ]);
    }
    public function destroy(Request $request)
    {
        $feedback = Feedback::where('user_id', auth()->id())
            ->where('id', $request->input('id'))
            ->first();

        if (!$feedback) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback não encontrado ou você não tem permissão para excluí-lo.',
            ], 404);
        }

        $feedback->delete();

        return response()->json([
            'success' => true,
            'message' => 'Feedback excluído com sucesso!',
        ]);
    }
}
