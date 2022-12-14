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
        "address",
        "address_detail",
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
        if($this->scheduled_at && $this->sheduled_at <= Carbon::now())
            return 0;

        return 1;
    }

}
