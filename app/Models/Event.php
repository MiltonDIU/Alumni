<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
//    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public const IS_FREE_SELECT = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    public const EVENT_STATUS_SELECT = [
        '0' => 'NonApprove (New Event)',
        '1' => 'Approve',
        '2' => 'Cancle',
        '3' => 'Archived',
    ];

    public $table = 'events';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'picture',
    ];

    protected $dates = [
        'created_at',
        'event_date',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_category_id',
        'district_id',
        'name',
        'upazila_id',
        'union_id',
        'address',
        'summary',
        'details',
        'is_free',
        'price',
        'created_at',
        'event_status',
        'event_date',
        'event_time',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function event_category()
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id');
    }

    public function getPictureAttribute()
    {
        $file = $this->getMedia('picture')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }

    public function schools()
    {
        return $this->belongsToMany(School::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getEventDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEventDateAttribute($value)
    {
        $this->attributes['event_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
