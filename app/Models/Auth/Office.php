<?php

namespace App\Models\Auth;

use App\Interfaces\ApiResourceInterface;
use App\Models\Share\District;
use App\Models\Share\Division;
use App\Models\Share\Union;
use App\Models\Share\Upazila;
use App\Traits\ScopeActive;
use App\Traits\Status;
use App\Traits\Utils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Auth\Office
 *
 * @property int $id
 * @property string $name
 * @property string|null $bn_name
 * @property string|null $org_code
 * @property string $office_type
 * @property string $jurisdiction
 * @property int $division_id
 * @property int|null $district_id
 * @property int|null $upazila_id
 * @property int|null $union_id
 * @property int|null $status_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read District|null $district
 * @property-read Division $division
 * @property-read \App\Models\Share\Status|null $status
 * @property-read Union|null $union
 * @property-read Upazila|null $upazila
 * @method static \Illuminate\Database\Eloquent\Builder|Office active()
 * @method static \Database\Factories\Auth\OfficeFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Office newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Office newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Office query()
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereBnName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereJurisdiction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereOfficeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereOrgCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUpazilaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Office whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Office extends Model implements ApiResourceInterface
{
    use HasFactory, Status, Utils, ScopeActive;

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

    public function formatResponse($is_detail = false): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'office_type'=>$this->office_type,
            'jurisdiction'=>$this->jurisdiction,
            'division_id'=>$this->division_id,
            'district_id'=>$this->district_id,
            'upazila_id'=>$this->upazila_id,
            'union_id'=>$this->union_id,
            'division_name'=>$this->division->name,
            'district_name'=>$this->district ? $this->district->name: 'N/A',
            'upazila_name'=>$this->upazila ? $this->upazila->name: 'N/A',
            'status_name'=>$this->status->title,
            'status_id'=>$this->status_id,
        ];
    }
}
