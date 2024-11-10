<?php

namespace App\Livewire;

use App\Http\Controllers\ReportController;
use Livewire\Component;

class ReportConfirmation extends Component
{
    public $forumId;
    public $isModalVisible = false;

    public function mount($forumId)
    {
        $this->forumId = $forumId;
    }

    public function openModal()
    {
        $this->isModalVisible = true;
    }

    public function closeModal()
    {
        $this->isModalVisible = false;
    }

    public function reportForum()
    {
        if($this->forumId == null)
        {
            session()->flash('flash.banner', 'Failed report forum, please try again later');
            session()->flash('flash.bannerStyle', 'danger');
        }

        $controller = new ReportController();
        return $controller->reportForum($this->forumId);
    }

    public function render()
    {
        return view('livewire.report-confirmation');
    }
}
