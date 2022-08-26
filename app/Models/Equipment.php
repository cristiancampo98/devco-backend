<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'so',
        'type'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
