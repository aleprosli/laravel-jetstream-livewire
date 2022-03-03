<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Post extends Component
{

    public $isOpen = 0;

    public function render()
    {
        return view('livewire.post');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->post_id = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
