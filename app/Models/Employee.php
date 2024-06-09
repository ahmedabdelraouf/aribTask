<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['first_name', 'last_name', 'salary', 'image', 'manager_name'];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getImageUrlAttribute()
    {
        $img = $this->attributes['image'];
        if (empty($img)) {
            $img = "images/defuser.jpg";
        }
        return url(Storage::url($img));
    }
}
