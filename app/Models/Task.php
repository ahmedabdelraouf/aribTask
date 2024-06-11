<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['subject', 'description', 'employee_id', 'status'];

    protected $dates = ['deleted_at'];

    // Define enum for status field
    public const STATUS_TODO = 'todo';
    public const STATUS_IN_PROGRESS = 'inprogress';
    public const STATUS_DONE = 'done';

    // Define allowed statuses
    public static $statuses = [
        self::STATUS_TODO,
        self::STATUS_IN_PROGRESS,
        self::STATUS_DONE,
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class,"employee_id",'id');
    }
}
