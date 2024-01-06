<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    use HasFactory;

    protected $fillable = [
        'rombel',
    ];

    public function User() 
    {
        //sebagai FK cukup panggil belongsTo : mengaitkan
        return $this->belongsTo(User::class);
    }
    public function Student()
    {
        return $this->hasMany(Student::class,  'rombel_id', 'id');
    }

    public function Late()
    {
        return $this->hasMany(Late::class);
    }
}
