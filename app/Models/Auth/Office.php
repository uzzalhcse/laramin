<?php

namespace App\Models\Auth;

use App\Models\Share\District;
use App\Models\Share\Division;
use App\Models\Share\Union;
use App\Models\Share\Upazila;
use App\Traits\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory, Status;

    protected $fillable = [
        'name',
        'bn_name',
        'org_code',
        'office_type',
        'jurisdiction',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'status_id'
    ];

    public const OFFICE_TYPES = [
        [
            'id'=>1,
            'title'=>'Deputy Commissioner Office',
            'slug'=>'deputy_commissioner_office'
        ],
        [
            'id'=>2,
            'title'=>'Ac Land Office',
            'slug'=>'ac_land_office'
        ],
        [
            'id'=>3,
            'title'=>'RRDC Office',
            'slug'=>'rrdc_office'
        ]
    ];
    public const DIVISION = 'Division';
    public const DISTRICT = 'District';
    public const UPAZILA = 'Upazila';
    public const UNION = 'Union';

    public const JURISDICTIONS = [
        self::DIVISION => self::DIVISION,
        self::DISTRICT => self::DISTRICT,
        self::UPAZILA => self::UPAZILA,
        self::UNION => self::UNION
    ];

    public function scopeActive($query){
        return $query->where('status_id',1);
    }

    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class);
    }

    public function union(){
        return $this->belongsTo(Union::class);
    }
}
