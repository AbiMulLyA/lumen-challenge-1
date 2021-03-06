<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $data = Author::all();
        if(!$data) {
            return response()->json([
                "message" => "Data Not Found"
            ]);
        }

        Log::info('Showing all author');

        return response()->json([
            "results" => $data
        ]);
    }

    public function showId($id)
    {
        $data = Author::find($id);
        if(!$data) {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }

        Log::info('Showing author by id');

        return response()->json([
            "results" => $data
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
        
        $data = new Author();
        $data->username = $request->input('username');
        $data->password = $request->input('password');
        $data->salt = $request->input('salt');
        $data->email = $request->input('email');
        $data->profile = $request->input('profile');
        $data->save();

        Log::info('Adding author');

        return response()->json([
            "message" => "Success Added",
            "results" => $data
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
        
        $data = Author::find($id);
        if ($data) {
            $data->username = $request->input('username');
            $data->password = $request->input('password');
            $data->salt = $request->input('salt');
            $data->email = $request->input('email');
            $data->profile = $request->input('profile');
            $data->save();

            Log::info('Updating author by id');

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
        $data = Author::find($id);
        if($data) {
            $data->delete();

            Log::info('Deleting author by id');

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
