<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\rombels;
use App\Models\rayons;
use App\Models\lates;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function rombels()
    {
        return $this->belongsTo(rombels::class, 'rombel_id', 'id');
    }

    public function rayons()
    {
        return $this->belongsTo(rayons::class, 'rayon_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function lates()
    {
        return $this->hasMany(Lates::class, 'student_id', 'id');
    }
}



