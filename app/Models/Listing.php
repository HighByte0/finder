<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    //protected $fillable = ['title', 'company', 'location', 'website', 'email', 'tags', 'description'];

    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false ){
            $query->where('tags','like','%'.request('tag').'%');
        }

        if ($filters['search'] ?? false) {
            $searchTerm = '%' . request('search') . '%';
        
            $query->where(function ($query) use ($searchTerm) {
                $query->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm)
                    ->orWhere('tags', 'like', $searchTerm);
            });
        }
        
        //if this code not fals do this following 
    }
    //relationship
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
