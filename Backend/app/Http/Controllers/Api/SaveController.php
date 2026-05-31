<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required',
            'bio' => 'nullable|string',
            'avatar' => 'image|mimes:png,jpg,jpeg,webp'
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatar', 'public');
            $user->update([
                'avatar' => $path
            ]);
        }

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'bio' => $request->bio,
        ]);

        return response()->json([
            'message' => 'Your Profile successfully updated'
        ]);
}
}
