<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index(Request $request) {
        $query = Prompt::with('tag', 'author', 'category');

        if ($request->sort === 'latest') {
            $query->latest('id');
        }

        if ($request->sort === 'oldest') {
            $query->oldest('id');
        }

        $data = $query->get();

        return response()->json($data);
    }
}
