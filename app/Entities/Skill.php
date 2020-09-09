<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['name'];
    
    public function candidates()
    {
        return $this->belongsToMany('App\Entities\Candidate', 'candidate_has_skills', 'skill_id', 'candidate_id');
    }
}
