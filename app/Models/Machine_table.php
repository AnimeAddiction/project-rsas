<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine_table extends Model
{
    public $table = 'machine';
    // timestamps is FALSE as to defer the Laravel's need for
    // UPDATED_AT where we already have updated_on in our database
    public $timestamps = FALSE;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'status',
        'room',
        'is_deleted',
    ];

    public function student_logsheet(){
        return $this->hasMany(Student_logsheet::class);
    }

    public function instructor_logsheet(){
        return $this->hasMany(Instructor_logsheet::class);
    }

    public function subject(){
        return $this->hasMany(Subject_table::class);
    }
}
