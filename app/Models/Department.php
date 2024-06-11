<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(mixed $validated)
 */
class Department extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function salaries()
    {
        return $this->employees()->sum("salary");
    }
}
