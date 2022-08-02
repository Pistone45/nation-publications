<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Receipt;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'duration',
        'price'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function receipt()
    {
       return $this->hasOne(Receipt::class);
    }  

}
