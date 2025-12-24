<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load(['comments', 'tags', 'category']);
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'tags' => 'nullable|array', 
            'tags.*' => 'exists:tags,id',
            'new_tags' => 'nullable|string',
        ]);

        if ($request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => trim($request->new_category)]);
            $validated['category_id'] = $category->id;
        }

        $validated['is_published'] = $request->has('is_published');

        $post = Post::create($validated);

        $tagsIds = $request->input('tags', []);

        if ($request->filled('new_tags')) {
            $tagNames = explode(',', $request->new_tags);
            foreach ($tagNames as $name) {
                $name = trim($name);
                if (!empty($name)) {
                    $tag = Tag::firstOrCreate(['name' => $name]);
                    $tagsIds[] = $tag->id;
                }
            }
        }

        $post->tags()->sync(array_unique($tagsIds));

        return redirect()->route('posts.index')->with('success', 'Post created!');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'new_category' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'new_tags' => 'nullable|string',
        ]);

        if ($request->filled('new_category')) {
            $category = Category::firstOrCreate(['name' => trim($request->new_category)]);
            $validated['category_id'] = $category->id;
        }

        $validated['is_published'] = $request->has('is_published');

        $post->update($validated);

        $tagsIds = $request->input('tags', []);

        if ($request->filled('new_tags')) {
            $tagNames = explode(',', $request->new_tags);
            foreach ($tagNames as $name) {
                $name = trim($name);
                if (!empty($name)) {
                    $tag = Tag::firstOrCreate(['name' => $name]);
                    $tagsIds[] = $tag->id;
                }
            }
        }

        $post->tags()->sync(array_unique($tagsIds));

        return redirect()->route('posts.index')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post deleted (softly)!');
    }
}