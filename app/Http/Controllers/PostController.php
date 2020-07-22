<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use App\Post;

class PostController extends Controller
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
        $data = Post::with(array('author'=>function($query){
                    $query->select();
                }))->get();
        if(!$data) {
            return response()->json([
                "message" => "Data Not Found"
            ]);
        }

        Log::info('Showing all post');

        return response()->json([
            "results" => $data
        ]);
    }

    public function showId($id)
    {
        $data = Post::find($id);
        if(!$data) {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }

        Log::info('Showing post by id');

        return response()->json([
            "results" => $data
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);
    
        $data = new Post();
        $data->title = $request->input('title');
        $data->content = $request->input('content');
        $data->tags = $request->input('tags');
        $data->status = $request->input('status');
        $data->author_id = $request->input('author_id');
        $data->save();

        Log::info('Adding post');

        return response()->json([
            "message" => "Success Added",
            "results" => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);
    
        $data = Post::find($id);
        if ($data) {
            $data->title = $request->input('title');
            $data->content = $request->input('content');
            $data->tags = $request->input('tags');
            $data->status = $request->input('status');
            $data->author_id = $request->input('author_id');
            $data->save();

            Log::info('Updating post by id');

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
        $data = Post::find($id);
        if($data) {
            $data->delete();

            Log::info('Deleting post by id');

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
