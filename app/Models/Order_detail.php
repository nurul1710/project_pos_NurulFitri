<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class order_detail extends Model
{
    protected $fillable=['order_id','product_id','qty','price'];
    use HasFactory;

    public function order():BelongsTo{
        return $this->belongsTo(order::class);
    }

    public function product():BelongsTo{
        return $this->belongsTo(product::class);
    }

}
