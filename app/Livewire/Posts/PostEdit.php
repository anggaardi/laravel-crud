<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Posts\PostForm;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public PostForm $form;
    public function updatePost()
    {
        $this->form->update();
        return redirect()->to('/posts');
    }
    public function render()
    {
        return view('livewire.posts.post-edit');
    }
}
