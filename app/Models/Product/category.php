<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = [
        "name",
        "image",
        
       
    ];

    public $timestamps = true; 
    
    // Defined relationships 
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
