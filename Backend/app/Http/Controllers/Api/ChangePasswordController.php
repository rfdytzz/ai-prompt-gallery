<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index(Request $request) {
        $password = Auth::user()->password;
        if (!Hash::check($request->old_password, $password)) {
            return response()->json([
                'message' => 'Incorrect Old Password'
            ],);
        }

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = Auth::user();
        $user->update([
            'password' => $request->new_password
        ]);

        return response()->json([
            'successMessage' => 'Password Change was successfull'
        ]);
    }
}
