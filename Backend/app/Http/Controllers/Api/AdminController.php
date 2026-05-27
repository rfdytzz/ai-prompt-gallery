<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user($id) {
        $data = User::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }
}
