<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\User;
use App\Models\Subscription;

class UserSubscription extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'subscription_id',
        'copies',
        'time_from',
        'time_to'
    ];

    public function status()
    {
     return $this->belongsTo(Status::class);
    }

    public function user()
    {
     return $this->belongsTo(User::class);
    }

    public function subscription()
    {
     return $this->belongsTo(Subscription::class);
    }


}
