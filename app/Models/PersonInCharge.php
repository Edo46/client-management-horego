<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonInCharge extends Model
{
    use HasFactory;
    protected $table = 'person_in_charge';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name', 'email', 'phone', 'avatar',
    ];
}
