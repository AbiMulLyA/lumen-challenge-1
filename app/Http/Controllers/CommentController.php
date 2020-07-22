<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Comment;

class CommentController extends Controller
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
        $data = Comment::with(array('author'=>function($query){
                    $query->select();
                }))->with(array('post'=>function($query){
                    $query->select();
                }))->get();
        if(!$data) {
            return response()->json([
                "message" => "Data Not Found"
            ]);
        }

        Log::info('Showing all comment');

        return response()->json([
            "results" => $data
        ]);
    }

    public function showId($id)
    {
        $data = Comment::find($id)->with(array('author'=>function($query){
            $query->select();
        }))->with(array('post'=>function($query){
            $query->select();
        }))->get();;
        if(!$data) {
            return response()->json([
                "message" => "Parameter Not Found"
            ]);
        }

        Log::info('Showing comment by id');

        return response()->json([
            "results" => $data
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);
    
        $data = new Comment();
        $data->content = $request->input('content');
        $data->status = $request->input('status');
        $data->author_id = $request->input('author_id');
        $data->email = $request->input('email');
        $data->url = $request->input('url');
        $data->post_id = $request->input('post_id');
        $data->save();

        Log::info('Adding comment');

        return response()->json([
            "message" => "Success Added",
            "results" => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);
    
        $data = Comment::find($id);
        if ($data) {
            $data->content = $request->input('content');
            $data->status = $request->input('status');
            $data->author_id = $request->input('author_id');
            $data->email = $request->input('email');
            $data->url = $request->input('url');
            $data->post_id = $request->input('post_id');
            $data->save();

            Log::info('Updating comment by id');

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
        $data = Comment::find($id);
        if($data) {
            $data->delete();

            Log::info('Deleting comment by id');

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
