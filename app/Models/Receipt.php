<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subscription;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'order_no'
    ];

    public function user()
    {
     return $this->belongsTo(User::class);
    }

    public function subscription()
    {
     return $this->belongsTo(Subscription::class);
    } 

}
