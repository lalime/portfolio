<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;

class Clients extends Component
{
    use WithFileUploads;
    
    public $clients;
    public Client $client;
    public $isOpen = 0;
    public $client_id;

    protected $rules = [
        'client.title' => 'required|min:3',
        'client.website' => 'nullable|url',
        'client.photos.*' => 'image|max:1024|nullable',
    ];

    public function render()
    {
        $this->clients = Client::all();
        return view('livewire.clients.index');
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
        // return view('livewire.clients.index');
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
        $this->logo = '';
        $this->website = '';
        $this->client_id = '';
    }

    public function save()
    {
        $this->validate();

        $this->logo = $this->logo->store('clients');

        Client::create([
            'title' => $this->title,
            'logo' => $this->logo,
            'website' => $this->website,
        ]);
        $this->client->save();


        session()->flash('message', 'Client successfully created.');

        return redirect()->to(route('dash.customers'));
    }
}
