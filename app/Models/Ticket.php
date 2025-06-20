<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'description','status','category_id'];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute(){
        return $this->category?->name ?? 'Sem categoria';
    }


    public function scopeFilter($query, array $filters){
        
        return $query
                    ->when($filters['title'] ?? false, fn($q, $title) =>
                        $q->where('title', 'like', "%$title%")
                    )
                    ->when($filters['status'] ?? false, fn($q, $status) =>
                        $q->where('status', $status)
                    )
                    ->when($filters['category_id'] ?? false, fn($q, $category) =>
                        $q->where('category_id', $category)
                    );
    }
}
