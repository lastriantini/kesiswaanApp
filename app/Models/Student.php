<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function Rombel() 
    {
        return $this->belongsTo(Rombel::class);
    }
    public function Rayon()
    {
        return $this->belongsTo(Rayon::class);
    }
    public function Late()
    {
        return $this->hasMany(Late::class,  'student_id', 'id');
    }
    
}
