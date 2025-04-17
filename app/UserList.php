<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];
}
