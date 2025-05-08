<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    public function admitCard()
    {
        return $this->hasOne(AdmitCard::class);
    }
    
    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }
}
