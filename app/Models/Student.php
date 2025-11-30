<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email', 
        'major',
        'year'
    ];

    protected $casts = [
        'year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Example of accessor - if needed for views
    public function getYearNameAttribute()
    {
        $yearNames = [
            1 => 'Freshman',
            2 => 'Sophomore', 
            3 => 'Junior',
            4 => 'Senior'
        ];
        
        return $yearNames[$this->year] ?? 'Unknown';
    }

    // Example of scope - for filtering in views
    public function scopeByMajor($query, $major)
    {
        return $query->where('major', $major);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }
}
