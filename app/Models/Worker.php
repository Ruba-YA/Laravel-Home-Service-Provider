<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function appointments()
    {
        return $this->hasOne(Appointment::class);
    }

    public function RecruitmentCountries()
    {
        return $this->belongsTo(RecruitmentCountries::class);
    }
}
