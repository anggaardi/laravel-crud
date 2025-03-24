<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Posts\PostForm;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public PostForm $form;
    public function mount(Post $post)
    {
        $this->form->setPost($post);
    }
    public function updatePost()
    {
        $this->form->update();
        session()->flash('success', 'post berhasil di edit');
        return redirect()->to('/posts');
    }
    public function render()
    {
        return view('livewire.posts.post-edit');
    }
}
