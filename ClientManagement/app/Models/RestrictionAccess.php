<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestrictionAccess extends Model
{
    use HasFactory;
    protected $table = 'restriction_access';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'person', 'organisation',
    ];
}
