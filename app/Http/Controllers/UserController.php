<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'User fetched successfully.',
            'users' => UserResource::collection($users)
        ], Response::HTTP_OK);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.index', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $validateData = $request->validated();

        $profileImage = $request->file('profile_image');
        $imagePath = $profileImage->store('profile_images', 'public');
        $validateData['profile_image'] = $imagePath;

        $user = User::create($validateData);
        
        return response()->json([
            'success' => true,
            'message' => 'User created successfully.',
            'user' => new UserResource($user)
        ], Response::HTTP_CREATED);
    }
}
