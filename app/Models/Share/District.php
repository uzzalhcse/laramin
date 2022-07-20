<?php

namespace App\Models\Share;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $hidden = [
      'created_at',
      'updated_at'
    ];
    public function upazilas(){
        return $this->hasMany(Upazila::class);
    }
}
