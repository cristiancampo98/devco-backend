<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];

    protected $with = ['equipment'];

    public function equipment()
    {
        return $this->hasOne(Equipment::class);
    }
}
