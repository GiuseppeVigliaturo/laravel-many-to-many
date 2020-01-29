<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'lastname'
    ];

    //definisco le varie relazioni 
    //attenzione a singolari e plurali

    public function tasks() {
        return $this -> belongsToMany(Task::class);
    }

    public function user() {
        return $this -> belongsTo(User::class);
    }
}
