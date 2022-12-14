<?php

namespace App\Models;

use App\Traits\Auditable;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class School extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
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

    public $table = 'schools';

    public static $searchable = [
        'name',
    ];

    protected $appends = [
        'picture',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'email',
        'contact_number',
        'about',
        'url',
        'is_active',
        'is_approve',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function schoolUsers()
    {
        return $this->hasMany(User::class, 'school_id', 'id');
    }

    public function schoolEvents()
    {
        return $this->belongsToMany(Event::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
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

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
