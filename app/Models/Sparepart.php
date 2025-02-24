<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function checkStock($qty)
    {
        return $this->stock >= $qty;
    }

    public function reduceStock($qty)
    {
        return $this->decrement('stock', $qty);
    }

}
