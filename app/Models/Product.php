<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;
    protected $fillable=['name','stock','price','category_id','description'];
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function order_detail():HasMany{
        return $this->hasMany(order_detail::class);
    }
}
