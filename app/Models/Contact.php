<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Contact extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'contact_address',
        'contact_description',
        'company_name',
        'job_title',
        'status',
        'created_by',
        'contact_image',
    ];

    public const STATUS = ['Lead', 'Prospect', 'Trial', 'Customer', 'Inactive'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function deals()
    {
        return $this->hasMany(Deal::class, 'contact_id', 'id');
    }
}
