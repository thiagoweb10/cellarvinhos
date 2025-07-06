<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'document',
        'phone',
        'email',
        'password',
        'role',
        'photo',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
    
    public function scopeFilter($query, array $filters): Builder
    {
        return $query
                    ->when($filters['name'] ?? false, fn($q, $name) =>
                        $q->where('name', 'like', "%$name%")
                    )
                    ->when($filters['document'] ?? false, fn($q, $document) =>
                        $q->where('document', $document)
                    )
                    ->when($filters['status'] ?? false, fn($q, $status) =>
                        $q->where('status', $status)
                    );
    }
}