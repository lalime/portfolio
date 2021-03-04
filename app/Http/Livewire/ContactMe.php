<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class ContactMe extends Component
{
    public $messages;
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $message_id;
    public $isOpen = 0;

    public function render()
    {
        $this->messages = Message::all();
        return view('livewire.contact-me');
    }

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
    }
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->message_id = '';
    }
      
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function store()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
    
        ContactMe::updateOrCreate(['id' => $this->message_id], [
            'title' => $this->title,
            'description' => $this->description
        ]);
   
        session()->flash(
            'message',
            $this->message_id ? 'Todo Updated Successfully.' : 'Todo Created Successfully.'
        );
   
        $this->closeModal();
        $this->resetInputFields();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function edit($id)
    {
        $Todo = Message::findOrFail($id);
        $this->todo_id = $id;
        $this->title = $Todo->title;
        $this->description = $Todo->description;
     
        $this->openModal();
    }
      
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function delete($id)
    {
        Message::find($id)->delete();
        session()->flash('message', 'Todo Deleted Successfully.');
    }
}
