<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentCountries extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function worker()
    {
        return $this->hasMany(Worker::class);
    }
}
