<?php

namespace App\Livewire\Posts;

use app\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!

class PostIndex extends Component
{
    public function render()
    {
        return view('livewire.posts.post-index', [
            'posts' => auth()->user()->posts()->latest()->get()

        ]);
    }
}
