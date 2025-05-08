<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmitCard extends Model
{
    public function jobApplication()
    {
        return $this->belongsTo(JobApplication::class);
    }
}
