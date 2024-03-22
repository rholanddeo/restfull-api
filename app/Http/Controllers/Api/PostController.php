<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        // return response()->json($posts);
        return new PostResource('success', 'Data retrieved successfully', $posts);
    }
}
