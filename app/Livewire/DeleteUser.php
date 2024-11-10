<?php

namespace App\Livewire;

use App\Http\Controllers\Admin\UserManagementController;
use Livewire\Component;

class DeleteUser extends Component
{
    public $userId;
    public $confirmingPassword = false;
    public $confirmablePassword;

    public function mount($user)
    {
        $this->userId = $user->id; // Set the userId from the passed-in $user
    }

    public function startConfirmingPassword($confirmableId)
    {
        $this->confirmingPassword = true;
        // Add any additional logic if necessary
    }

    public function confirmPassword()
    {
        // Get the authenticated user
        $authenticatedUser = auth()->user();

        // Check if the entered password matches the authenticated user's password
        if (!\Hash::check($this->confirmablePassword, $authenticatedUser->password)) {
            // If the password is incorrect, set an error
            $this->addError('confirmable_password', 'The password is incorrect.');
            return;
        }

        // If the password is correct, proceed to delete the user
        if (!$this->userId) {
            // Call the UserManagementController's delete method
            session()->flash('flash.banner', 'Failed delete user, please try again later');
            session()->flash('flash.bannerStyle', 'danger');
        }
        $controller = new userManagementController();
        return $controller->delete($this->userId);
    }



    public function stopConfirmingPassword()
    {
        $this->confirmingPassword = false;
    }

    public function render()
    {
        return view('livewire.delete-user');
    }
}

