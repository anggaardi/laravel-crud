<?php

namespace App\Livewire\Forms\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;
    public $title = '';
    public $image; // Ubah dari protected menjadi public
    public $content = '';
    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function store()
    {
        $data = $this->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['slug'] = str()->slug($data['title']);

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        auth()->user()->posts()->create($data);

        // Reset form setelah penyimpanan berhasil
        $this->reset(['title', 'image', 'content']);
    }

    public function update()
    {
        $data = $this->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['slug'] = str()->slug($data['title']);

        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        auth()->user()->posts()->create($data);

        // Reset form setelah penyimpanan berhasil
        $this->reset(['title', 'image', 'content']);
    }
}
