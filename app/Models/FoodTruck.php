<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\OpeningHours\OpeningHours;

class FoodTruck extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const ACTIVE_SELECT = [
        'Active'     => 'Active',
        'Not Active' => 'Not Active',
    ];

    public $table = 'food_trucks';

    protected $appends = [
        'image', 'thumbnail'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'address',
        'active',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function truckReviews()
    {
        return $this->hasMany(Review::class, 'truck_id', 'id');
    }
    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('image', 'thumb');
    }

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function days()
    {
        return $this->belongsToMany(Day::class)->withPivot('from_hours', 'from_minutes', 'to_hours', 'to_minutes');
    }

    public function getWorkingHoursAttribute()
    {
        $hours = $this->days
            ->pluck('pivot', 'name')
            ->map(function($pivot) {
                return [
                    $pivot['from_hours'].':'.$pivot['from_minutes'].'-'.$pivot['to_hours'].':'.$pivot['to_minutes']
                ];
            });

        return OpeningHours::create($hours->toArray());
    }
    public function scopeSearchResults($query)
    {
        return $query->where('active', 'Active')
            ->when(request()->filled('search'), function($query) {
                $query->where(function($query) {
                    $search = request()->input('search');
                    $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('address', 'LIKE', "%$search%");
                });
            })
            ->when(request()->filled('cuisine'), function($query) {
                $query->whereHas('cuisines', function($query) {
                    $query->where('id', request()->input('cuisines'));
                });
            });
    }

}
