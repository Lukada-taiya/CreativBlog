<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'company', 'website', 'tags', 'location','email', 'description', 'logo'];

    public function scopeFilter($query, array $filters) { 
        if($filters['tags'] ?? false) {
            $query->where('tags', 'like', '%'. request('tags').'%');
        }

        if($filters['search'] ?? false) {
            $query->where('tags', 'like', '%'. request('search').'%')
            ->orWhere('description', 'like', '%'. request('search').'%')
            ->orWhere('title', 'like', '%'. request('search').'%');
        }
    }
}
