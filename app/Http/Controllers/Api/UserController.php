<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($data))
            return UserResource::make(Auth::user());

        return response()->json(['message' => 'Email или пароль введены неверно'], 401);
    }

    public function list() {
        return AuthorResource::collection(User::all());
    }

    public function show($id) {
        $user = User::with(['books'])->where('id', $id)->first();
        if ($user == null)
            return response()->json(['message' => 'Пользователь с таким id не найден'], 400);
        return AuthorResource::make($user);
    }

    public function update(Request $request, $id) {

        $user = User::find($id);
        if ($user === null)
            return response()->json(['message' => 'Пользователь с таким ид не существует'], 400);

        $data = $request->validate([
            'firstname' => ['string', 'max:255'],
            'lastname' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['string', 'min:8'],
        ]);

        if (isset($data['password']))
            $data['password'] = Hash::make($data['password']);

        if (!empty($data))
            $user->update($data);

        return UserResource::make($user);
    }
}
