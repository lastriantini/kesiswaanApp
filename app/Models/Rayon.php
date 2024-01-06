<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rayon extends Model
{
    use HasFactory;

    protected $table = 'rayons';

    protected $fillable = [
        'rayon',
        'user_id',
    ];

    public function User() 
    {
        return $this->belongsTo(User::class);
    }

    public function Student()
    {
        return $this->hasMany(Student::class,  'rayon_id', 'id');
    }

    public function Late()
    {
        return $this->hasMany(Late::class);
    }
}
