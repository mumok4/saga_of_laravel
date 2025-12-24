<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $posts = Post::with(['tags', 'category'])
                     ->published()
                     ->paginate(10);
        
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'exists:categories,id',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id'
        ]);

        $post = Post::create($validated);
        
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::with(['tags', 'comments', 'category'])->findOrFail($id);
        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $post->update($request->only(['title', 'content', 'is_published', 'category_id']));

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}