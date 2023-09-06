<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'deadline',
        'status',
        'remarks'
    ];

    public const STATUS = ['Open', 'In Progress', 'Pending', 'Cancelled', 'Completed'];
}
