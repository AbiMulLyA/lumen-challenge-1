<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $comment = [
            [
                "id" => 1,
                "content" => "Perjalanan",
                "status" => "Active",
                "create_time" => "2020-08-26",
                "author_id" => 1,
                "email" => "gunda@gmail.com",
                "url" => "http://letsblog081.blogspot.com/",
                "post_id" => 1,
            ],
            [
                "id" => 2,
                "content" => "Perkampungan",
                "status" => "Active",
                "create_time" => "2020-08-27",
                "author_id" => 1,
                "email" => "bajah@gmail.com",
                "url" => "http://letsblog081.blogspot.com/",
                "post_id" => 2,
            ],
            [
                "id" => 3,
                "content" => "Perpulangan",
                "status" => "Non Active",
                "create_time" => "2020-08-28",
                "author_id" => 1,
                "email" => "yuja@gmail.com",
                "url" => "http://letsblog081.blogspot.com/",
                "post_id" => 1,
            ]
        ];

        Log::info('Showing all comment');

        return response()->json([
            "results" => $comment
        ]);
    }

    public function showId($id)
    {
        $comment = [
            [
                "id" => $id,
                "content" => "Perkampungan",
                "status" => "Active",
                "create_time" => "2020-08-27",
                "author_id" => 1,
                "email" => "bajah@gmail.com",
                "url" => "http://letsblog081.blogspot.com/",
                "post_id" => 2,
            ]
        ];

        Log::info('Showing comment by id');

        return response()->json([
            "results" => $comment
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'create_time' => 'required',
            'author_id' => 'required',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required',
        ]);
    
        $content = $request->input('content');
        $status = $request->input('status');
        $create_time = $request->input('create_time');
        $author_id = $request->input('author_id');
        $email = $request->input('email');
        $url = $request->input('url');
        $post_id = $request->input('post_id');

        $comment = [
            [
                "id" => rand(10, 100),
                "content" => $content,
                "status" => $status,
                "create_time" => $create_time,
                "author_id" => $author_id,
                "email" => $email,
                "url" => $url,
                "post_id" => $post_id,
            ]
        ];

        Log::info('Adding comment');

        return response()->json([
            "message" => "Success Added",
            "results" => $comment
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'create_time' => 'required',
            'author_id' => 'required',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required',
        ]);
    
        $content = $request->input('content');
        $status = $request->input('status');
        $create_time = $request->input('create_time');
        $author_id = $request->input('author_id');
        $email = $request->input('email');
        $url = $request->input('url');
        $post_id = $request->input('post_id');

        $comment = [
            [
                "id" => $id,
                "content" => $content,
                "status" => $status,
                "create_time" => $create_time,
                "author_id" => $author_id,
                "email" => $email,
                "url" => $url,
                "post_id" => $post_id,
            ]
        ];

        Log::info('Updating comment by id');

        return response()->json([
            "message" => "Success Updated",
            "results" => $comment
        ]);        
    }

    public function delete($id)
    {
        Log::info('Deleting comment by id');

        return response()->json([
            "message" => "Success Deleted",
            "results" => [
                "id" => $id
            ]
        ]);    
    }
}
