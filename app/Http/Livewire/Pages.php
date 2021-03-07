<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class Pages extends Component
{
    use WithFileUploads;
    
    public Page $page;
    public $featured;
    public $isOpen = 0;

    public function mount()
    {
        $this->page = new Page;
    }

    protected $rules = [
        'page.title' => 'required|min:3',
        'page.description' => 'nullable',
        'featured' => 'image|max:1024|nullable',
    ];

    public function render()
    {
        return view('livewire.pages.index', [
                'pages' => Page::paginate(10)
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
    public function edit(Page $page)
    {
        dd($page);
        $this->page = $page;

        $this->openModal();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private function resetInputFields()
    {
        $this->page = new Page();
    }

    public function store()
    {
        $this->validate();
        
        if ($this->featured) {
            $featuredUrl = $this->featured->store('pages', 'public');
            // Fill logo field
            $this->page->fill(['featured' => $featuredUrl]);
        }
        
        $this->page->save();

        session()->flash('message', 'Page successfully created.');

        return redirect()->to(route('dashboard.pages'));
    }
}