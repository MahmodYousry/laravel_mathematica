<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

  public function index() {
    $posts = Post::latest()->paginate(3);
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
    $post->thumbnail = $request->blogImage;
    $post->content = $request->content;
    $post->user_id = auth()->user()->id;

    // if there is image upload and save it in db
    if ($request->hasFile('thumbnail')) {
      $imageFile = $request->file('thumbnail');
      $imageGenaratedName = time() . '_' . $imageFile->getClientOriginalName();
      $path = $imageFile->storeAs('', $imageGenaratedName, 'posts_images');
      $post->thumbnail = $path;
    }

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
      $post = Post::find($id);

      // Check if post exists before proceeding
      if (!$post) {
        return redirect()->route('blog.index')->with('error', 'Post not found');
      }


      $post->title = $request->title;
      $post->content = $request->content;
      $post->user_id = auth()->user()->id;

      if ($request->hasFile('thumbnail')) {
        // Delete old image if exists
        if ($post->thumbnail) {
          Storage::disk('posts_images')->delete($post->thumbnail);
        }

        // Save the new image
        $imageFile = $request->file('thumbnail');
        $imageGeneratedName = time() . '_' . $imageFile->getClientOriginalName();
        $path = $imageFile->storeAs('', $imageGeneratedName, 'posts_images'); // '' since 'posts_images' disk already points to the folder
        $post->thumbnail = $path;
      }

      $post->save();

      return redirect()->route('blog.index')->with('success', 'Post Edited Successfuly');

    } catch (\Exception $e) {
      return redirect()->route('blog.index')->with('error', 'Failed to delete post: ' . $e->getMessage());
    }
  }

  public function destroy(Request $request, $id)
  {

    try {
      $post = Post::find($id);
      // Check if the post has a thumbnail
      if ($post->thumbnail) {
              // Ensure the file exists before attempting to delete it
          if (Storage::disk('posts_images')->exists($post->thumbnail)) {
              // Attempt to delete the file
              Storage::disk('posts_images')->delete($post->thumbnail);
          } else {
              throw new \Exception('Thumbnail file does not exist.');
          }
      }

      // Attempt to delete thumbnail record from the database
      if (!$post->delete()) {
        // If the deletion fails, throw an exception
        throw new \Exception('Failed to delete thumbnail.');
      }

      $paginator = Post::paginate(3);
      $redirectToPage = ($request->page <= $paginator->lastPage()) ? $request->page : $paginator->lastPage();

      return redirect()->route('blog.index', ['page' => $redirectToPage])->with('success', 'Post deleted successfully !');

    } catch (\Exception $e) {
      return redirect()->route('blog.index', ['page' => $request->page])->with('error', 'Failed to delete post: ' . $e->getMessage());
    }
  }
}
