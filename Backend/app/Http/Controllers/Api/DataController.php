<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Prompt;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function totalData() {
        $totalUser = User::count();
        $totalPrompt = Prompt::count();
        $totalCategory = Category::count();
        $totalTag = Tag::count();

        return response()->json([
            'totalUser' => $totalUser,
            'totalPrompt' => $totalPrompt,
            'totalCategory' => $totalCategory,
            'totalTag' => $totalTag
        ]);
    }

    public function user() {
        $data = User::latest()->get();

        return response()->json([
            'data' => $data
        ]);
    }
}
