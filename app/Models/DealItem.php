<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'deal_id',
        'item_id',
    ];

    public $timestamps = false;

}
