<?php

namespace App\Livewire;

use Livewire\Component;

class DeleteConfirmation extends Component
{
    public $successMessage;
    public $isModalVisible = true; // Set to true to display the modal initially

    public function closeModal()
    {
        $this->isModalVisible = false; // Close the modal
    }

    public function render()
    {
        return view('livewire.delete-confirmation');
    }
}
