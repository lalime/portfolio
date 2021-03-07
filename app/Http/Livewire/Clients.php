<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;

class Clients extends Component
{
    use WithFileUploads;
    
    public Client $client;
    public $logo;
    public $isOpen = 0;
    public $client_id;

    protected $rules = [
        'client.title' => 'required|min:3',
        'client.website' => 'nullable|url',
        'logo' => 'image|max:1024|nullable',
    ];

    public function mount()
    {
        $this->client = new Client;
    }

    public function render()
    {
        return view('livewire.clients.index', 
            [
                'clients' => Client::paginate(10)
            ]
        );
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
    public function edit(Client $client)
    {
        $this->client = $client;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->client->title = '';
        $this->client->logo = '';
        $this->client->website = '';
    }

    public function store()
    {
        $this->validate();
        
        if ($this->logo) {
            $logoUrl = $this->logo->store('clients', 'public');
            // Fill logo field
            $this->client->fill(['logo' => $logoUrl]); 
        }
        
        $this->client->save();

        session()->flash('message', 'Client successfully created.');

        return redirect()->to(route('dash.customers'));
    }
}
