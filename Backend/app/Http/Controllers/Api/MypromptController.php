<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Prompt;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypromptController extends Controller
{
    public function index() {
        $user = Auth::id();
        $data = Prompt::with('author', 'tag', 'category')->where('author_id', $user)->get();
        $category = Category::all();

        return response()->json([
            'data' => $data
        ]);
    } 

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'thumbnail' => 'image|mimes:png,jpg,jpeg,webp',
            'description' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
            'prompt' => 'required',
            'author_id' => 'required'
        ]);

        $user = auth()->user();

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnail', 'public');

            Prompt::create([
                'thumbnail' => $path
            ]);
        }

        Prompt::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'tag_id' => $request->tag_id,
            'author_id' => $user,
            'prompt' => $request->prompt
        ]);

        return response()->json([
            'message' => 'new Prompt added'
        ]);
    }

    public function getDataTag() {
        $tag = Tag::all();

        return response()->json([
            'tag' => $tag
        ]);
    }
    public function getDataCategory() {
        $category = Category::all();

        return response()->json([
            'category' => $category
        ]);
    }
}
