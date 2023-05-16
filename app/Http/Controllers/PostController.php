<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index() {
        $posts = Post::all();
        return view('dashboard.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('dashboard.blog.create');
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return redirect()->route('blog.index')->with('success', trans('blog.success'));

    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('dashboard.blog.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('dashboard.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            if ($post->update($request->all())) {
                return redirect()->route('blog.index')->with('success', 'Post Edited Successfuly');
            } else {
                return redirect()->route('blog.index')->with('error', 'Failed To Edit The Post.');
            }
        }
        catch (\Exception $e) {
            return redirect()->route('blog.index')->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {

        try {
            $post = Post::findOrFail($id);
            if ($post->delete()) {
                return redirect()->route('blog.index')->with('success', 'Post deleted successfully !');
            } else {
                return redirect()->route('blog.index')->with('error', 'Failed To Delete The Post.');
            }
        }

        catch (\Exception $e) {
            return redirect()->route('blog.index')->with('error', 'Failed to delete post: ' . $e->getMessage());
        }
    }
}
