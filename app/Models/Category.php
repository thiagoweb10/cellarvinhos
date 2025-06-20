<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }

    public function scopeFilter($query, array $filters){
        
        return $query
                    ->when($filters['name'] ?? false, fn($q, $name) =>
                        $q->where('name','LIKE',"%{$name}%")
                    );
    }
}
