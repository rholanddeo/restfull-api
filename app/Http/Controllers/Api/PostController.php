<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        // return response()->json($posts);
        return new PostResource(true, 'Data retrieved successfully', $posts);
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => Str::slug($request->title),
            'image' => $image->hashName(),
        ]);

        return new PostResource(true, 'Post created successfully', $post);
    }

    public function show(Post $post)
    {
        return new PostResource(true, 'Data retrieved successfully', $post);
    }

    public function update(Request $request, Post $post)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());
            Storage::delete('public/posts/' . $post->image);
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'image' => $image->hashName(),
            ]);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
            ]);
        }

        return new PostResource(true, 'Post updated successfully', $post);
    }
}
