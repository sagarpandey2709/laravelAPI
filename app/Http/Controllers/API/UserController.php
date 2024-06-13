<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index()
    {
        $users = User::all();
        if ($users->count() > 0) {
            $data = [
                'status' => 200,
                'users' => $users,
                'message' => 'Successful get User Data.'
            ];
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Records Found.',
            ];
        }
        return response()->json($data, 200);
    }

    public function Store(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $data = [
            'status' => 200,
            'message' => 'User successfully created.'
        ];
        return response()->json($data, 200);
    }

    public function show($user)
    {
        $user = User::find($user);
        if ($user) {
            $data = [
                'status' => 200,
                'user' => $user,
                'message' => 'Successfully retrieved user data.'
            ];
        } else {
            $data = [
                'status' => 500,
                'user' => '',
                'message' => 'Something Went Wrong!'
            ];
        }

        return response()->json($data, 200);
    }

    public function update(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        // Check if password is being updated
        if (array_key_exists('password', $validated) && $validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // If password is not in the request, remove it from the validated data
            unset($validated['password']);
        }

        // Update only the fields that are present in the validated data
        $user->update($validated);

        $data = [
            'status' => 200,
            'user' => $user,
            'message' => 'User successfully updated.'
        ];
        return response()->json($data, 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        $data = [
            'status' => 200,
            'message' => 'User successfully deleted.'
        ];
        return response()->json($data, 200);
    }
}
