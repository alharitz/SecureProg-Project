<?php

namespace App\Livewire;

use App\Models\Forum;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RemoveImage extends Component
{
    public $forum; // Declare the forum property

    public function mount($forum)
    {
        $this->forum = $forum; // Initialize the forum property with the passed forum
    }

    public function removeImage()
    {
        if ($this->forum->forum_images_path) {
            Storage::delete($this->forum->forum_images_path);
            $this->forum->forum_images_path = null; // Remove image path
            $this->forum->save();

            session()->flash('message', 'Image removed successfully.');
        }
    }

    public function render()
    {
        // Return the view without redirecting
        return view('livewire.remove-image');
    }
}


