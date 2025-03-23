<?php

namespace App\Livewire\Forms\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post = null; // Inisialisasi agar tidak error
    public $title = '';
    public $image;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['image'] = $this->post?->image ?? null;
        $data['user_id'] = auth()->id();

        if ($this->image) {
            if ($this->post instanceof Post) {
                Storage::disk('public')->delete($this->post->image);
            }
            $data['image'] = $this->image->store('posts', 'public');
        }

        if ($this->post instanceof Post) {
            $this->post->update($data);
        } else {
            $this->post = Post::create($data);
        }

        // Reset form setelah penyimpanan berhasil
        $this->reset(['title', 'image', 'content']);
    }

    public function update()
    {
        $data = $this->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data['slug'] = str()->slug($data['title']);
        $data['user_id'] = auth()->id();

        if ($this->image) {
            if ($this->post && $this->post->image) {
                Storage::disk('public')->delete($this->post->image);
            }
            $data['image'] = $this->image->store('posts', 'public');
        } else {
            $data['image'] = $this->post->image ?? null;
        }

        if ($this->post) {
            $this->post->update($data);
        }

        $this->reset(['title', 'image', 'content']);
    }
}
