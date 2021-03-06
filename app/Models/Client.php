<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    use HasFactory;
    
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'customers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'logo', 'website',
    ];

    public function logoUrl()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo))
            return Storage::disk('public')->url($this->logo);

        return 'https://www.gravatar.com/205e460b479e2e5b48aec07710c08d50';
    }
}
