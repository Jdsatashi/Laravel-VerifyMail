<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'start',
      'end',
      'schedule',
      'course_id'
    ];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function assigns(){
        return $this->hasMany(Assign::class);
    }

    public function assignBy(User $user){
        return $this->assigns->contains('user_id', $user->id);
    }
}
