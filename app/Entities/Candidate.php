<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Candidate extends Model
{
    use Searchable;

    protected $fillable = ['name', 'email', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'candidate_has_skills', 'candidate_id', 'skill_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'candidate_id', 'id');
    }

    public function searchableAs()
    {
        return 'id';
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->status,
            'notes' => $this->notes,
            'skills' => $this->skills,
        ];
    }
}
