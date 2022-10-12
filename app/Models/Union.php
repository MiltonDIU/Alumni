<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Union extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Auditable;

    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'unions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'upazila_id',
        'name',
        'slug',
        'bn_name',
        'url',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function unionSchools()
    {
        return $this->hasMany(School::class, 'union_id', 'id');
    }

    public function unionAddresses()
    {
        return $this->hasMany(Address::class, 'union_id', 'id');
    }

    public function unionEvents()
    {
        return $this->hasMany(Event::class, 'union_id', 'id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
