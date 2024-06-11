<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'password',
        'salary', 'image', 'manager_id', 'department_id','role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }


    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, "department_id", "id");

    }

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, "manager_id", "id");
    }

    /**
     * @return BelongsTo
     */
    public function tasksCount(): HasMany
    {
        return $this->hasMany(Task::class, "employee_id", "id");
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

    // Define enum for status field
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_EMPLOYEE = 'employee';

    // Define allowed statuses
    public static $roles = [
        self::ROLE_ADMIN,
        self::ROLE_MANAGER,
        self::ROLE_EMPLOYEE,
    ];
}
