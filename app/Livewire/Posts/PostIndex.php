<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostIndex extends Component
{
    use WithPagination;

    protected $listeners = ['confirmDelete' => 'deletePost']; // Untuk trigger SweetAlert

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$post) {
            session()->flash('error', 'Post tidak ditemukan atau bukan milik Anda.');
            return;
        }

        // Hapus gambar jika ada

        Storage::disk('public')->delete($post->image);


        $post->delete();

        session()->flash('success', 'Post berhasil dihapus.');

        // Emit event untuk me-refresh daftar post
        $this->dispatch('postDeleted');
    }

    public function cleanSession()
    {
        session()->forget('success');
    }

    public function render()
    {
        return view('livewire.posts.post-index', [
            'posts' => auth()->user()->posts()->latest()->paginate(5)
        ]);
    }
}
