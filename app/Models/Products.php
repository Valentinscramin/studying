<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primarykey = 'id';
    protected $fillable = ['name', 'description', 'price', 'categorie_id', 'img'];
    use HasFactory;

    public function categorie()
    {
        return $this->belongsTo(Categories::class);
    }
}
