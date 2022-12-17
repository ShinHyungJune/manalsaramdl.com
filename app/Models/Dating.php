<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dating extends Model
{
    use HasFactory;

    protected $fillable = [
        "read_men",
        "read_women",
        "check_address",
        "address_name",
        "place_name",
        "place_url",
        "city1",
        "area1",
        "city2",
        "area2",
        "schedule1",
        "schedule2",
        "schedule3",
        "schedule4",
        "schedule5",
        "scheduled_at",
    ];

    public function getOngoingAttribute()
    {
        if($this->scheduled_at && Carbon::make($this->scheduled_at) <= Carbon::now())
            return 0;

        return 1;
    }

    public function getCanChatAttribute()
    {
        if($this->ongoing && $this->scheduled_at && Carbon::make($this->scheduled_at)->subDay()->startOfDay() <= Carbon::now())
            return 1;

        return 0;
    }

    public function women()
    {
        return $this->belongsTo(User::class, "women_id");
    }

    public function men()
    {
        return $this->belongsTo(User::class, "men_id");
    }

    public function chat()
    {
        return $this->hasOne(Chat::class);
    }

}
