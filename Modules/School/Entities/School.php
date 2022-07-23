<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\School\Database\factories\SchoolFactory;
use Modules\Student\Entities\Student;

class School extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];

    protected static function newFactory()
    {
        return SchoolFactory::new();
    }

    //Relation
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
