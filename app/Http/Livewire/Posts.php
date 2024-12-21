<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
  use WithPagination; // Enables Livewire pagination

  public $searchKey;
  protected  $searchResults;

  protected $paginationTheme = 'bootstrap';
  protected $queryString = ['searchKey'];

  public function updatingSearchKey(): void
  {
    // Reset pagination when search key is updated
    $this->resetPage();
  }

  public function search()
  {
    // Trigger search logic when the button is clicked
    $this->resetPage();

    $query = Post::latest();

    if ($this->searchKey) {
      $query->where('title', 'like', '%' . $this->searchKey . '%');
    }

    $this->searchResults = $query->paginate(5); // Paginate results
  }

  public function getPostsProperty()
  {
    // Use searchResults if available, otherwise load default products
    return $this->searchResults ?: Post::latest()->paginate(3);
  }

  public function render()
  {
    $posts = Post::latest()->paginate(3);
    return view('livewire.posts', ['posts' => $posts]);
  }

}
