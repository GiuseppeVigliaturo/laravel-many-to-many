<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable =[
        'phone',
        'birthYear'
    ];

    public function user(){
        return $this -> belongsTo(User::class);
    }
}
