<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

use Image;

class UserController extends Controller
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
        $data = User::all();
        if(!$data) {
            return response()->json([
                "message" => "Data Not Found"
            ]);
        }

        return response()->json($data);
    }

    public function showId($id)
    {
        $data = User::find($id);
        if(!$data) {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }

        return response()->json($data);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);

        $data = new User();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = Hash::make($request->input('password'));
        $data->save();

        return response()->json([
            "message" => "Success Added",
            "results" => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6',
        ]);
        
        $data = User::find($id);
        if($data) {
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->save();

            return response()->json([
                "message" => "Success Updated",
                "results" => $data
            ]);
        }else {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }        
    }

    public function delete($id)
    {
        $data = User::find($id);
        if($data) {
            $data->delete();

            return response()->json([
                "message" => "Success Deleted",
                "results" => $data
            ]);
        }else {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }        
    }
}
