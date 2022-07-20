<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    public function unions(){
        return $this->hasMany(Union::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
}
