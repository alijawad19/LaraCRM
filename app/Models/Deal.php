<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "contact_id",
        "owner_id",
        "deal_amount",
        // "deal_items" => 'array',
        "note",
        'created_on',
        "closed_on",
        "status",
    ];

    public const STATUS = ['10%', '20%', '40%', '60%', '80%', 'Won', 'Lost'];

    public $timestamps = false;

    public function deal_items()
    {
        return $this->hasMany(DealItem::class, 'deal_id', 'id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }
}
