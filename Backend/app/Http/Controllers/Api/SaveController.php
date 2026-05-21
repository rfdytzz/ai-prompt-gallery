<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required',
            'bio' => 'nullable|string'
        ]);

        $user = auth()->user();
        $user->update($request->all());

        return response()->json([
            'message' => 'Your Profile successfully updated'
        ]);
}
}
