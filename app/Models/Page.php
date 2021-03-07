<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = ['title', 'featured', 'description'];


    public function featuredUrl()
    {
        if ($this->featured && Storage::disk('public')->exists($this->featured))
            return Storage::disk('public')->url($this->featured);

        return 'https://www.gravatar.com/205e460b479e2e5b48aec07710c08d50';
    }
}