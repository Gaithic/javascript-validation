<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function office()
    {
       return $this->belongsTo(OfficesName::class, 'office_id');
    }

    public function districts()
    {
       return $this->belongsTo(District::class, 'district_id');
    }


    public function circles()
    {
       return $this->belongsTo(Circle::class, 'circle_id');
    }

    public function divisions()
    {
       return $this->belongsTo(Division::class, 'division_id');
    }


    public function ranges()
    {
       return $this->belongsTo(Range::class, 'range_id');
    }

    
    public function activity()
    {
       return $this->belongsTo(Activity::class, 'user_id');
    }


    public function activities()
    {
      return $this->hasMany(Activity::class, 'user_id');
    }


    public function profile()
    {
       return $this->belongsTo(profile::class, 'user_id');
    }

    

}
