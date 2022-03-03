<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $title, $description, $post_id, $posts;

    public $isOpen = 0;

    public function render()
    {
        //declare variable posts at top
        $this->posts = Post::all();

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

    //validation rules
    protected $rules = [
        'title' => 'required|min:6',
        'description' => 'required',
    ];
    
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

    public function storeWithValidation()
    {
        $this->validate();
 
        // Execution doesn't reach here if validation fails
        Post::updateOrCreate(
            ['id' => $this->post_id],
            [
            'title' => $this->title,
            'description' => $this->description
            ]
        );

        //return message
        session()->flash('message', 'Post Created Successfully.');
  
        //call closemodal
        $this->closeModal();

        //call resetform
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->body = $post->body;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

}
