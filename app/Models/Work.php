<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;
    use Auditable;

    public const IS_CURRENT_JOB_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const VIEW_ON_PUBLICLY_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'works';

    protected $dates = [
        'joining_date',
        'resign_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'field_of_work_id',
        'organization_id',
        'designation_id',
        'joining_date',
        'resign_date',
        'is_current_job',
        'created_at',
        'view_on_publicly',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function field_of_work()
    {
        return $this->belongsTo(FieldOfWork::class, 'field_of_work_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function getJoiningDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setJoiningDateAttribute($value)
    {
        $this->attributes['joining_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getResignDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setResignDateAttribute($value)
    {
        $this->attributes['resign_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
