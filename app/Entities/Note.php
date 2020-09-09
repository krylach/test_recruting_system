<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['comment', 'candidate_id'];

    public function candidate()
    {
        return $this->hasOne('App\Entities\Candidate', 'id', 'candidate_id');
    }

    public function createdDate()
    {
        return date('d.m', strotime($this->created_at));
    }
}
