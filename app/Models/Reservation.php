<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;

class Reservation extends Model
{
    use HasFactory, AsSource, Filterable, Attachable;

    protected $fillable = [
        'parking_lot_id',
        'picture',
        'from',
        'to',
    ];

    protected $allowedFilters = [
        'from',
    ];

    protected $appends = ['my_picture'];


    protected static function boot()
    {
        parent::boot();
        if (!app()->runningInConsole()) {
            self::saving(function ($table) {
                $table->user_id = auth()->id();
            });
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parking_lot()
    {
        return $this->belongsTo(ParkingLot::class);
    }


    public function picture()
    {
        return $this->hasOne(Attachment::class, 'id', 'picture')->withDefault();
    }


    public function getMyPictureAttribute()
    {
        $url = $this->picture;
        if ($this->picture()->first()) {
            $url = $this->picture()->first()->relativeUrl;
        }

        return $url;

    }

}
