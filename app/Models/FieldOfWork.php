<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldOfWork extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Auditable;

    public const IS_ACTIVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const IS_APPROVE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public $table = 'field_of_works';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'is_approve',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fieldOfWorkWorks()
    {
        return $this->hasMany(Work::class, 'field_of_work_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
