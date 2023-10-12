<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;
    protected $table = 'organisation';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name', 'phone', 'email', 'website', 'logo', 'pic'
    ];
}
