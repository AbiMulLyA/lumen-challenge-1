<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showAll()
    {
        $author = [
            [
                "id" => 1,
                "username" => "Bret",
                "password" => "bret123",
                "salt" => "1",
                "email" => "Sincere@april.biz",
                "profile" => "Kulas Light"
            ],
            [
                "id" => 2,
                "username" => "Antonette",
                "password" => "Antonette",
                "salt" => "1",
                "email" => "Shanna@melissa.tv",
                "profile" => "Kulas Light"
            ]
        ];

        return response()->json([
            "results" => $author
        ]);
    }

    public function showId($id)
    {
        $author = [
            [
                "id" => 1,
                "username" => "Bret",
                "password" => "bret123",
                "salt" => "1",
                "email" => "Sincere@april.biz",
                "profile" => "Kulas Light"
            ]
        ];

        return response()->json([
            "results" => $author
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'salt' => 'required',
            'email' => 'required',
            'profile' => 'required',
        ]);
        
        $username = $request->input('username');
        $password = $request->input('password');
        $salt = $request->input('salt');
        $email = $request->input('email');
        $profile = $request->input('profile');

        $author = [
            [
                "id" => rand(10, 100),
                "username" => $username,
                "password" => $password,
                "salt" => $salt,
                "email" => $email,
                "profile" => $profile
            ]
        ];

        return response()->json([
            "message" => "Success Added",
            "results" => $author
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'salt' => 'required',
            'email' => 'required',
            'profile' => 'required',
        ]);
        
        $username = $request->input('username');
        $password = $request->input('password');
        $salt = $request->input('salt');
        $email = $request->input('email');
        $profile = $request->input('profile');

        $author = [
            [
                "id" => $id,
                "username" => $username,
                "password" => $password,
                "salt" => $salt,
                "email" => $email,
                "profile" => $profile
            ]
        ];

        return response()->json([
            "message" => "Success Updated",
            "results" => $author
        ]);        
    }

    public function delete($id)
    {
        return response()->json([
            "message" => "Success Deleted",
            "results" => [
                "id" => $id
            ]
        ]);    
    }
}
