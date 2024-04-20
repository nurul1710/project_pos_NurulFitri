<?php

namespace App\Models;

use App\Livewire\Orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class customer extends Model
{
    use HasFactory;
    protected $fillable=['name','email','phone','address'];

    public function order():HasMany{
        return $this->hasMany(order::class);
    }
}
