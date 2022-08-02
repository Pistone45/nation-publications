<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserSubscription;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user_subscription()
    {
       return $this->hasOne(UserSubscription::class);
    }


}
