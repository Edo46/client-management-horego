<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedOrganisation extends Model
{
    use HasFactory;
    protected $table = 'assigned_organisation';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id', 'organisation_id'
    ];

    public function organisation()
    {
        return $this->hasOne(Organisation::class, 'id', 'organisation_id');
    }
}
