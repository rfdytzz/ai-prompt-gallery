<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;

class PromptController extends Controller
{
    public function index() {
        $data = Prompt::with('tag', 'author', 'category')->get();

        return response()->json($data);
    }
}
