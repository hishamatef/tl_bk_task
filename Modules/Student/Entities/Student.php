<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\School\Entities\School;
use Modules\Student\Database\factories\StudentFactory;

class Student extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];
    protected $hidden=['created_at','updated_at'];

    protected static function newFactory()
    {
        return StudentFactory::new();
    }

    public function getStudentOrder($school_id)
    {
        $max = Student::where('school_id',$school_id)->max('order');
        return $max?$max + 1:1;
    }

    public function save($options = array())
    {
        if($this->school_id && !isset($this->order)) {
            $this->order = $this->getStudentOrder($this->school_id);
        }
        return parent::save($options);
    }
    //Relation
    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
