<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'lastname'
    ];

    public function tasks() {
        return $this -> belongsToMany(Task::class);
    }
}
