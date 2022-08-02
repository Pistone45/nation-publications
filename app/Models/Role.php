<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Role;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function user()
    {
       return $this->hasOne(User::class);
    }


    public function storeRole($role_name, $description)
    {

        try {

        //Saving the Role
        $role = new Role();
        $role->name = $role_name;
        $role->description = $description;
        $role->save();

        $added = "Role Added";
        return \Session::put('role_added', $added);

        } catch (Exception $e) {
            $error = "There was an error";
            return \Session::put('error', $error);            
        }

    }

}
