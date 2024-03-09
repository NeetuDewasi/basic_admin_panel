<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomAuthUserController extends Controller
{
    public function getAuthUser()
    {
        $authUser = Auth::user();
        $user = User::find($authUser);

        if ($user) {
            return response(['user' => $user], 200);
        }

        return response(['message' => 'No User found'], 404);
    }

    public function updateUserAdmin(Request $request)
    {
        $image = '';
        if ($request->hasFile('photo')) {
            $image = '/storage/' . $request->file('photo')->store('user/avatar');
        }

        $authUser = Auth::user();

        if (!$authUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'No User found'
            ], 404); // HTTP status code 404 for resource not found
        }

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_text' => $request->password,
            'photo' => $image
        ];

        $update = $authUser->update($userData);
        if ($update) {
            return response()->json([
                'status' => 'success',
                'message' => 'User Updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update user'
            ], 500);
        }
    }

}
