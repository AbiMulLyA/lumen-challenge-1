<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $post = [
            [
                "id" => 1,
                "title" => "Jalan di Pagi Hari",
                "content" => "Perjalanan",
                "tags" => "Jalan",
                "status" => "Active",
                "create_time" => "2020-08-26",
                "update_time" => "2020-08-27",
                "author_id" => 1,
            ],
            [
                "id" => 2,
                "title" => "Jalan di Siang Hari",
                "content" => "Perjalanan",
                "tags" => "Jalan",
                "status" => "Active",
                "create_time" => "2020-08-26",
                "update_time" => "2020-08-27",
                "author_id" => 2,
            ],
            [
                "id" => 3,
                "title" => "Jalan di Sore Hari",
                "content" => "Perjalanan",
                "tags" => "Jalan",
                "status" => "Non Active",
                "create_time" => "2020-08-26",
                "update_time" => "2020-08-27",
                "author_id" => 3,
            ]
        ];

        Log::info('Showing all post');

        return response()->json([
            "results" => $post
        ]);
    }

    public function showId($id)
    {
        $post = [
            [
                "id" => $id,
                "title" => "Jalan di Sore Hari",
                "content" => "Perjalanan",
                "tags" => "Jalan",
                "status" => "Non Active",
                "create_time" => "2020-08-26",
                "update_time" => "2020-08-27",
                "author_id" => 3,
            ]
        ];

        Log::info('Showing post by id');

        return response()->json([
            "results" => $post
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'create_time' => 'required',
            'update_time' => 'required',
            'author_id' => 'required',
        ]);
    
        $title = $request->input('title');
        $content = $request->input('content');
        $tags = $request->input('tags');
        $status = $request->input('status');
        $create_time = $request->input('create_time');
        $update_time = $request->input('update_time');
        $author_id = $request->input('author_id');

        $post = [
            [
                "id" => rand(10, 100),
                "title" => $title,
                "content" => $content,
                "tags" => $tags,
                "status" => $status,
                "create_time" => $create_time,
                "update_time" => $update_time,
                "author_id" => $author_id,
            ],
        ];

        Log::info('Adding post');

        return response()->json([
            "message" => "Success Added",
            "results" => $post
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'create_time' => 'required',
            'update_time' => 'required',
            'author_id' => 'required',
        ]);
    
        $title = $request->input('title');
        $content = $request->input('content');
        $tags = $request->input('tags');
        $status = $request->input('status');
        $create_time = $request->input('create_time');
        $update_time = $request->input('update_time');
        $author_id = $request->input('author_id');

        $post = [
            [
                "id" => $id,
                "title" => $title,
                "content" => $content,
                "tags" => $tags,
                "status" => $status,
                "create_time" => $create_time,
                "update_time" => $update_time,
                "author_id" => $author_id,
            ],
        ];

        Log::info('Updating post by id');

        return response()->json([
            "message" => "Success Updated",
            "results" => $post
        ]);        
    }

    public function delete($id)
    {
        Log::info('Deleting post by id');

        return response()->json([
            "message" => "Success Deleted",
            "results" => [
                "id" => $id
            ]
        ]);    
    }
}
