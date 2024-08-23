<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primarykey = 'id';
    protected $fillable = ['user_id'];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_products()
    {
        return $this->hasMany(CartProducts::class);
    }
}
