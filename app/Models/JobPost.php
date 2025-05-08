<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    public function positions()
    {
        return $this->hasMany(Position::class);
    }
    public function jobApplications()
    {
        return $this->hasMany(JobApplication::class);
    }
    
}
