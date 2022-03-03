<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title, $description, $post_id;

    public $isOpen = 0;

    public function render()
    {
        return view('livewire.posts');
    }

    public function create()
    {
        //call reset column
        $this->resetInputFields();

        //call modal
        $this->openModal();
    }

    private function resetInputFields()
    {
        //reset column
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

    public function store()
    {
        //updateorcreate, check id, and column declared on top
        Post::updateOrCreate(
            ['id' => $this->post_id],
            [
            'title' => $this->title,
            'description' => $this->description
            ]
        );

        //return message
        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
  
        //call closemodal
        $this->closeModal();

        //call resetform
        $this->resetInputFields();
    }
}
