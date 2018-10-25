<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Illustration extends Model
{
    //Table Name
    protected $table = 'illustrations';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public  $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
