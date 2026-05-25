<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prompt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypromptController extends Controller
{
    public function index() {
        $user = Auth::id();
        $data = Prompt::with('author', 'tag', 'category')->where('author_id', $user)->get();

        return response()->json([
            'data' => $data
        ]);
    } 
}
