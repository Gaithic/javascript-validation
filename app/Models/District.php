<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function circles()
    {
        return $this->hasMany(Circle::class, 'district_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity(){
        return $this->belongsTo(Activity::class);
    }
}
