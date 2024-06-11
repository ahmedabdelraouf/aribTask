<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $first_name
 * @property mixed $last_name
 */
class Employee extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['first_name', 'last_name', 'salary', 'image', 'manager_name', 'department_id'];

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class,"department_id","id");

    }

    /**
     * @return BelongsTo
     */
    public function tasksCount(): HasMany
    {
        return $this->hasMany(Task::class,"employee_id","id");
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * @return Application|UrlGenerator|\Illuminate\Foundation\Application|string
     */
    public function getImageUrlAttribute(): \Illuminate\Foundation\Application|string|UrlGenerator|Application
    {
        $img = $this->attributes['image'];
        if (empty($img)) {
            $img = "images/defuser.jpg";
        }
        return url(Storage::url($img));
    }
}
